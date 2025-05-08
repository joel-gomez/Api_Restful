<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_an_author(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/authors', [
            'name' => 'Gabriel García Márquez',
            'birthdate' => '1927-03-06',
            'nationality' => 'Colombiano',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Gabriel García Márquez']);
    }

    public function test_can_list_authors(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')->postJson('/api/authors', [
            'name' => 'Autor de prueba',
            'birthdate' => '1980-01-01',
            'nationality' => 'Paraguayo',
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/authors');

        $response->assertStatus(200)
                 ->assertJsonStructure([['id', 'name', 'birthdate', 'nationality']]);
    }

    public function test_can_show_author(): void
    {
        $user = User::factory()->create();

        $responseCreate = $this->actingAs($user, 'sanctum')->postJson('/api/authors', [
            'name' => 'Isabel Allende',
            'birthdate' => '1942-08-02',
            'nationality' => 'Chilena',
        ]);

        $authorId = $responseCreate->json('id');

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/authors/{$authorId}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Isabel Allende']);
    }

    public function test_can_update_author(): void
    {
        $user = User::factory()->create();

        $responseCreate = $this->actingAs($user, 'sanctum')->postJson('/api/authors', [
            'name' => 'Nombre Original',
            'birthdate' => '1990-01-01',
            'nationality' => 'Original',
        ]);

        $authorId = $responseCreate->json('id');

        $response = $this->actingAs($user, 'sanctum')->putJson("/api/authors/{$authorId}", [
            'name' => 'Nombre Actualizado',
            'birthdate' => '1990-01-01',
            'nationality' => 'Actualizado',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Nombre Actualizado']);
    }

    public function test_can_delete_author(): void
    {
        $user = User::factory()->create();

        $responseCreate = $this->actingAs($user, 'sanctum')->postJson('/api/authors', [
            'name' => 'Autor a eliminar',
            'birthdate' => '1990-01-01',
            'nationality' => 'Eliminar',
        ]);

        $authorId = $responseCreate->json('id');

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/authors/{$authorId}");

        // Cambiar la expectativa a 200
        $response->assertStatus(200); // Esperar 200 en vez de 204

        $this->assertDatabaseMissing('authors', ['id' => $authorId]);
    }
}
