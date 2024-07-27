<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpClient\Chunk\ServerSentEvent;
use Symfony\Component\HttpClient\EventSourceHttpClient;
use Symfony\Component\HttpClient\HttpClient;

class OpenAIController extends Controller
{
    protected $userId;

    // Constructor
    public function __construct()
    {
        // Initialize any property
        $this->userId = 1;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                sleep(2);
                $messages = ChatMessage::orderBy('created_at', 'asc')->paginate(50);
                return response()->json(['status' => true, 'message' => "Messages loaded successfully!", 'data' => $messages]);
            } catch (Exception $e) {
                Log::error('get chat error:', ['message' => $e->getMessage()]);
                return response()->json(['status' => false, 'message' => 'An error has occurred, please try again later.'], 500);
            }
        }
        return view('open-ai.index');
    }
    public function store(Request $request)
    {
        $request->validate(['message' => 'required']);
        try {
            sleep(2);
            $open_ai = config('app.openai.key');
            $response = $this->createThread($open_ai);
            $message = ChatMessage::create([
                'user_id' => $this->userId,
                'from' => 'USER',
                'message' => $request->message,
                'conversation_id'=> $response['id']
            ]);
            return response()->json(['status' => true, 'message' => "Message store successfully!", 'data' => $message]);

        } catch (Exception $e) {
            Log::error('store chat error:', ['message' => $e->getMessage()]);
            return response()->json(['status' => false, 'message' => 'An error has occurred, please try again later.'], 500);
        }

        // // Respond with a chatbot message
        // ChatMessage::create([
        //     'user_id' => null,
        //     'from' => 'BOT',
        //     'message' => 'Thank you for your message!',
        // ]);

        // return redirect()->back();
    }
    public function chatProcessOld(Request $request)
    {
        $chatId = $request->chat_id;
        $chat = ChatMessage::find($chatId);
        try {
            $ch = curl_init();

            if ($ch === false) {
                throw new Exception('Failed to initialize cURL');
            }

            $apiKey = config('app.openai.key');
            $model = $request->input('model', 'gpt-3.5-turbo-0125'); // Default to 'gpt-3.5-turbo' if not provided
            $url = 'https://api.openai.com/v1/chat/completions';

            // $data = [
            //     'model' => $model,
            //     'prompt' => "How are you",//$chat->message, // Default prompt if not provided
            //     'max_tokens' => $request->input('max_tokens', 7), // Default to 7 if not provided
            // ];
            $data = [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => "How are you",
                            ],
                            // [
                            //     'type' => 'image_url',
                            //     'image_url' => [
                            //         'url' => null,
                            //     ],
                            // ],
                        ],
                    ],
                ],
                'max_tokens' => 2500,
                'stream' => true,
            ];

            $payload = json_encode($data);

            Log::info('cURL Initialization: ' . ($ch ? 'Success' : 'Failed'));
            Log::info('API Key: ' . $apiKey);
            Log::info('Model: ' . $model);
            Log::info('URL: ' . $url);
            Log::info('Payload: ' . $payload);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey,
            ]);

            $response = curl_exec($ch);

            Log::info('cURL Response: ' . $response);

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                Log::error('cURL Error: ' . $error);
                throw new Exception($error);
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            Log::info('HTTP Code: ' . $httpCode);

            if ($httpCode !== 200) {
                throw new Exception('HTTP error code: ' . $httpCode);
            }

            curl_close($ch);

            return response()->json(json_decode($response, true));
        } catch (Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function chatProcess(Request $request)
    {
        $chatId = $request->chat_id;
        Log::info('chatId : ' . $chatId);
        return response()->stream(function () use ($chatId) {
            $text = "";

            $chat = ChatMessage::find($chatId);

            Log::info('chat Data : ' . $chat);

            $latest_message = [
                'role' => 'user',
                'content' => $chat->message,
            ];

            $open_ai = config('app.openai.key');

            Log::info('open_ai key : ' . $open_ai);

            $this->createMessage($open_ai, $chat->conversation_id, $latest_message);
            Log::info('createMessage end :');
            $client = HttpClient::create();
            $client = new EventSourceHttpClient($client, reconnectionTime: 2);

            $url = 'https://api.openai.com/v1/threads/' . $chatId . '/runs';

            Log::info('createMessage url :'. $url);

            $headers = [
                'OpenAI-Beta' => 'assistants=v2',
                'Authorization' => 'Bearer ' . $open_ai,
                'Content-Type' => 'application/json',
            ];
            Log::info('headers url :');

            $model = "gpt-4o";
            $body = json_encode([
                'assistant_id' => $chatId,
                'model' => $model,
                'stream' => true,
            ]);

            Log::info('body url :'. $body);

            try {
                Log::info('client try start :');
                $source = $client->request(
                    method: 'POST',
                    url: $url,
                    options: [
                        'buffer' => false,
                        'headers' => $headers,
                        'body' => $body,
                    ],
                );
                Log::info('client try start source :');
                while ($source) {
                    foreach ($client->stream($source) as $chunk) {
                        if ($chunk instanceof ServerSentEvent) {

                            $raw = $chunk->getArrayData();

                            if ($raw['object'] == 'thread.message.delta') {
                                $answer = $raw['delta']['content'][0]['text']['value'];
                                $text .= $answer;
                                $clean = str_replace(["\r\n", "\r", "\n"], "<br/>", $answer);
                                echo "data: " . $clean;
                                echo "\n\n";
                                ob_flush();
                                flush();

                            } elseif ($raw['object'] == 'thread.run') {
                                if ($raw['status'] == 'completed') {
                                    break;
                                }

                            }

                        } else {
                            break;
                        }
                    }
                }

                echo 'data: [DONE]';
                echo "\n\n";
                ob_flush();
                flush();

            } catch (Exception $e) {
                echo 'data: [DONE]';
                echo "\n\n";
                ob_flush();
                flush();
            }

            # Update credit balance
            // $words = count(explode(' ', ($text)));
            // HelperService::updateBalance($words, $main_chat->model);

            // $current_chat = ChatHistory::where('id', $chat_id)->first();
            // $current_chat->response = $text;
            // $current_chat->words = $words;
            // $current_chat->save();

            // // Respond with a chatbot message
            ChatMessage::create([
                'user_id' => $this->userId,
                'from' => 'BOT',
                'message' => $text,
            ]);

        }, 200, [
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
            'Content-Type' => 'text/event-stream',
        ]);
    }
    public function createMessage($openai, $thread_id, $messages)
    {
        Log::info('openai key : ' . $openai);
        Log::info('thread_id key : ' . $thread_id);
        // Log::info('messages key : ' . $messages);

        $url = 'https://api.openai.com/v1/threads/' . $thread_id . '/messages';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messages));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'OpenAI-Beta: assistants=v2',
            'Authorization: Bearer ' . $openai,
        ));

        $result = curl_exec($ch);
        Log::info('messages key : ' . $result);
        curl_close($ch);

        $response = json_decode($result, true);

        Log::info('response createMessage : ');

        return $response;

    }
    public function createThread($openai)
    {
        $url = 'https://api.openai.com/v1/threads';

        $ch = curl_init();
                    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'OpenAI-Beta: assistants=v2',
            'Authorization: Bearer ' . $openai,
        )); 

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result , true);

        return $response;

    }
}
