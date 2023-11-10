<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to list all questions created by me', function () {
    $wronguser      = User::factory()->create();
    $wrongquestions = Question::factory()->for($wronguser, 'createdBy')
            ->count(10)
            ->create();

    $user      = User::factory()->create();
    $questions = Question::factory()->for($user, 'createdBy')
            ->count(10)
            ->create();

    //Act

    //Acessar a rota
    actingAs($user);
    $response = get(route('question.index'));

    //Assert
    //Verificar se alista de perguntas está sendo mostrada.

    //** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

    //** @var Question $q */
    foreach ($wrongquestions as $q) {
        $response->assertDontSee($q->question);
    }

});
