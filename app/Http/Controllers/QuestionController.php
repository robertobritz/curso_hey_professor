<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        $attribute = request()->validate([
            'question' => ['required', 'min:10'],
        ]);

        Question::query()->create($attribute);

        return to_route('dashboard');
    }
}
