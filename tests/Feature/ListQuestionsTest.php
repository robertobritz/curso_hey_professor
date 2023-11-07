<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all the quesitons', function () {
    //Arrange
    //Criar algumas perguntas
    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    actingAs($user); // Serve para se logar

    //Act
    //Acessar a rota
    $response = get(route('dashboard'));

    //Assert
    //Verificar se alista de perguntas está sendo mostrada.

    //** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
