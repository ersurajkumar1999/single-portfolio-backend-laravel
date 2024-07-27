@extends('layout.main', [
'title' => 'Chat GPT',
])

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Chat GPT</h4>
  @include('open-ai.open-ai-section')
</div>
@endsection

@section('js_script')
<script type="text/javascript">
  let chats = [];
  let bot_avatar = "";
  let user_avatar = "";

  const dynamicChatList = document.querySelector(".chat-history");;

  $(document).ready(function() {
    let currentPage = 1;
    loadChatHistory(currentPage);

    $('#sendMessageForm').on('submit', function(event) {
      event.preventDefault();
      toggleLoading(true);
      let code = makeid(10);
      let formData = new FormData(this);
      $('#sendMessageForm')[0].reset();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('open-ai.store') }}", // Replace with your route
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(chatRresponse) {
          if (chatRresponse.status) {
            let data = chatRresponse.data;
            $('#sendMessageForm')[0].reset();
            appendMessage(user_avatar, data)
            // chatProcess(data);
            let chatURL = "{{route('open-ai.chat-process')}}";
            eventSource = new EventSource(chatURL + "?chat_id=" + data.id);
            const response = document.getElementById(code);
            const chatbubble = document.getElementById('chat-bubble-' + code);
            let msg = '';
            let i = 0;

            eventSource.onopen = function(e) {
              response.innerHTML = '';
            };

            eventSource.onmessage = function(e) {

              if (e.data == "[DONE]") {
                msgerSendBtn.disabled = false
                eventSource.close();
                $msg_txt.html(escape_html(msg));
                $div.data('message', msg);
                hljs.highlightAll();
                uploaded_image = '';

              } else {
                let txt;
                txt = e.data


                if (txt !== undefined) {
                  msg = msg + txt;

                  let str = msg;
                  if (str.indexOf('<') === -1) {
                    str = escape_html(msg)
                  } else {
                    str = str.replace(/[&<>"'`{}()\[\]]/g, (match) => {
                      switch (match) {
                        case '<':
                          return '&lt;';
                        case '>':
                          return '&gt;';
                        case '{':
                          return '&#123;';
                        case '}':
                          return '&#125;';
                        case '(':
                          return '&#40;';
                        case ')':
                          return '&#41;';
                        case '[':
                          return '&#91;';
                        case ']':
                          return '&#93;';
                        default:
                          return match;
                      }
                    });
                    str = str.replace(/(?:\r\n|\r|\n)/g, '<br/>');
                  }

                  $msg_txt.html(str);
                  hljs.highlightAll();

                  //response.innerHTML += txt.replace(/(?:\r\n|\r|\n)/g, '<br>');
                }
                msgerChat.scrollTop += 100;
              }
            };

            eventSource.onerror = function(e) {
              msgerSendBtn.disabled = false
              console.log(e);
              eventSource.close();
            };
          }
        },
        error: function(xhr) {
          toastr.error('An error has occurred, please try again later.');
        }
      });
    });

    function loadChatHistory(page) {
      setChatPreloading(true);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'GET',
        url: "{{route('open-ai.index')}}",
        data: {
          'page': page
        },
        success: function(response) {
          if (response.status) {
            let data = response.data.data;
            chats.unshift(...data);
            setChatHistory();
            setChatPreloading(false);
          }

          // hljs.highlightAll();
        },
        error: function(xhr, status, error) {
          // Display a custom error message
          // alert("Something went wrong, please try again.");
          setChatPreloading(false);
        }
      });
    }

    function chatProcess(chat) {
      // setChatPreloading(true);
      // alert("dell");
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: "{{route('open-ai.chat-process')}}",
        data: {
          'chat_id': chat.id
        },
        success: function(response) {
          console.log("response.status", response);
          // if(response.status){
          //   let data = response.data.data;
          //   chats.unshift(...data);
          //   setChatHistory();
          //   setChatPreloading(false);
          // }

          // hljs.highlightAll();
        },
        error: function(xhr, status, error) {
          // Display a custom error message
          // alert("Something went wrong, please try again.");
          setChatPreloading(false);
        }
      });
    }

    function appendMessage(avatar, chat) {
      let msgHTML;
      msgHTML = `
            <li class="chat-message chat-message-right">
                <div class="d-flex overflow-hidden">
                <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                    <p class="mb-0">${chat.message}</p>
                  </div>
                  <div class="text-end text-muted mt-1">
                    <i class='bx bx-check-double text-success'></i>
                    <small>${chat.time}</small>
                  </div>
                </div>
                <div class="user-avatar flex-shrink-0 ms-3">
                  <div class="avatar avatar-sm">
                    <img src="{{asset('assets/images/default.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
              </div>
            </li>`;

      dynamicChatList.insertAdjacentHTML("beforeend", msgHTML);
    }

    function appendMessageSpecial(avatar, chat) {
      let msgHTML;
      msgHTML = `
            <li class="chat-message">
              <div class="d-flex overflow-hidden">
                <div class="user-avatar flex-shrink-0 me-3">
                  <div class="avatar avatar-sm">
                    <img src="{{asset('assets/images/logo/openai.svg')}}" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
                <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                    <p class="mb-0">${chat.message}</p>
                  </div>
                  <div class="text-muted mt-1">
                    <small>${chat.time}</small>
                  </div>
                </div>
              </div>
            </li>`;

      dynamicChatList.insertAdjacentHTML("beforeend", msgHTML);
      // msgerChat.scrollTop += 500;
    }

    function setChatHistory() {
      chats.forEach((chat, index) => {
        if (chat.from == "BOT") {
          appendMessageSpecial(bot_avatar, chat);
        }
        if (chat.from == "USER") {
          appendMessage(user_avatar, chat);
        }
      });

      // hljs.highlightAll(); // Re-highlight code blocks if any
    }

    function setChatPreloading(status) {
      $('.chat-preloading').css({
        'display': status ? 'block' : 'none'
      });
    }

    function toggleLoading(isLoading) {
      if (isLoading) {
        $('.send-msg-btn-loading').css({
          'display': isLoading ? 'block' : 'none'
        });
        $('.send-msg-btn').css({
          'display': isLoading ? 'none' : 'block'
        });
      } else {
        $('.send-msg-btn-loading').css({
          'display': isLoading ? 'none' : 'none'
        });
        $('.send-msg-btn').css({
          'display': isLoading ? 'block' : 'none'
        });
      }
    }

    // Generate a random value
    function makeid(length) {
      let result = '';
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      const charactersLength = characters.length;
      let counter = 0;
      while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
      }
      return result;
    }
  })
</script>
@endsection