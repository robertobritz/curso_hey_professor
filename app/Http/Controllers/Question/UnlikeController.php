<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class UnlikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        user()->unlike($question); // Criada uma function em app\suppor\functions para retornar o usuário logado com o user(), adicionado caminho no composer.json

        return back();
    }
}
