<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class OpenAIController extends Controller
{
    protected $userId;

    // Constructor
    public function __construct()
    {
        // Initialize any property
        $this->userId = 1;
    }
    public function index()
    {
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return view('open-ai.index', compact('about'));
    }
}
