<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('Should be able to publish a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true]);

    actingAs($user);

    put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh(); // serve para atualizar os dados no banco de dados.

    expect($question)
        ->draft->toBeFalse();
});
