<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('Should be able to create a new question bigger than 255 caracters', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user); // Vou logar esse meu fake usuário

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: verificar
    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

// it('Should check if ends with question mak ?', function(){

// });

// it('Should have at least 10 characters', function(){

// });
