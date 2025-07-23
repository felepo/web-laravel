<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function show(Question $question)
    {
        $question->load('answers', 'category', 'user');

        return view('questions.show', [
            "question" => $question,
        ]);
    }
}
