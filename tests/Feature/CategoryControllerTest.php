<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_index()
    {
        Category::factory(5)->create();

        $response = $this->getJson('/api/categories');

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $response->assertJsonCount(5);
    }

    public function test_create_new_category()
    {
        $data = [
            'name' => 'Hola',
        ];
        $response = $this->postJson('/api/categories', $data);

        $response->assertSuccessful();
        // $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('categories', $data);
    }

    public function test_update_category()
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $data = [
            'name' => 'Update categories',
        ];

        $response = $this->patchJson("/api/categories/{$category->getKey()}", $data);
        $response->assertSuccessful();
        // $response->assertHeader('content-type', 'application/json');
    }

    public function test_show_category()
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $response = $this->getJson("/api/categories/{$category->getKey()}");

        $response->assertSuccessful();
        // $response->assertHeader('content-type', 'application/json');
    }

    public function test_delete_category()
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->getKey()}");

        $response->assertSuccessful();
        // $response->assertHeader('content-type', 'application/json');
        $this->assertDeleted($category);
    }
}
