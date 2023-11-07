<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View // para controladores de uma única função.
    {
        return view('dashboard', [
            'questions' => Question::withSum('votes', 'like')
                ->withSum('votes', 'unlike')
                ->get(),
        ]);
    }
}
