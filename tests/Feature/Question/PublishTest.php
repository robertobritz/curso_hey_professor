<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('Should be able to publish a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()
                ->for($user, 'createdBy') // Serve para a gente atrelar o usuário
                ->create(['draft' => true]);
    //->create(['draft' => true, 'created_by' => $user->id]); //Poderia substituir o for

    actingAs($user);

    put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh(); // serve para atualizar os dados no banco de dados.

    expect($question)
        ->draft->toBeFalse();
});

it('should make sure that only the person who has created the question can publish the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);

    put(route('question.publish', $question))
        ->assertForbidden();

    actingAs($rightUser);

    put(route('question.publish', $question))
        ->assertRedirect();
});
