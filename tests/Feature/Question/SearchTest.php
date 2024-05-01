<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to serach a qustion by text', function () {
    //Arrange
    //Criar algumas perguntas
    $user = User::factory()->create();
    Question::factory()->create(['question' => 'Something else?']);
    Question::factory()->create(['question' => 'My question is?']);

    actingAs($user); // Serve para se logar

    //Act
    //Acessar a rota
    $response = get(route('dashboard', ['search' => 'question']));

    //Assert
    //Verificar se alista de perguntas está sendo mostrada.

    //** @var Question $q */

    $response->assertDontSee('Something else?');
    $response->assertSee('My question is?');
});
