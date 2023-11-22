<?php

use App\Models\{Question, User};
use Illuminate\Pagination\LengthAwarePaginator;

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

it('should paginate the result', function () {
    $user      = User::factory()->create();
    $questions = Question::factory()->count(20)->create();

    actingAs($user);

    // get(route('dashboard'))
    //     ->assertViewHas('questions', function($value){
    //         return $value instanceof LengthAwarePaginator;
    //     });
    //pode ser escrito assim também:
    get(route('dashboard'))
    ->assertViewHas('questions', fn ($value) => $value instanceof LengthAwarePaginator);
});
