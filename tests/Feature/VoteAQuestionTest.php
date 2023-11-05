<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('Should be able to like a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.like', $question))->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);

    //verificação do banco de dados:
    //SELECT * FROM votes WHERE qustion_id = ? AND like = 1 AND unlike = 0, AND user_id =? EXISTS

});
