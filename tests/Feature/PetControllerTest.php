<?php

namespace Tests\Feature;

use App\Services\PetService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class PetControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = Mockery::mock(PetService::class);
        $this->app->instance(PetService::class, $this->mock);
    }

    public function testIndex()
    {
        $this->mock->shouldReceive('fetchPetsByStatus')->once()->with('available')->andReturn([
            ['id' => 1, 'name' => 'Dog', 'status' => 'available'],
            ['id' => 2, 'name' => 'Cat', 'status' => 'available'],
        ]);

        $response = $this->get('/pets');

        $response->assertStatus(200);
        $response->assertViewIs('pets.index');
        $response->assertViewHas('pets');
    }

    public function testCreate()
    {
        $response = $this->get('/pets/create');

        $response->assertStatus(200);
        $response->assertViewIs('pets.create');
    }

    public function testStore()
    {
        $petData = [
            'id' => 1,
            'name' => 'New Dog',
            'status' => 'available'
        ];

        $this->mock->shouldReceive('createPet')->once()->with(Mockery::on(function ($arg) use ($petData) {
            return $arg['id'] == $petData['id'] && $arg['name'] == $petData['name'] && $arg['status'] == $petData['status'];
        }))->andReturn($petData);

        $response = $this->post('/pets', $petData);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
    }

    public function testShow()
    {
        $petData = [
            'id' => 1,
            'name' => 'Dog',
            'status' => 'available'
        ];

        $this->mock->shouldReceive('fetchPetById')->once()->with(1)->andReturn($petData);

        $response = $this->get('/pets/1');

        $response->assertStatus(200);
        $response->assertViewIs('pets.show');
        $response->assertViewHas('pet', $petData);
    }

    public function testEdit()
    {
        $petData = [
            'id' => 1,
            'name' => 'Dog',
            'status' => 'available'
        ];

        $this->mock->shouldReceive('fetchPetById')->once()->with(1)->andReturn($petData);

        $response = $this->get('/pets/1/edit');

        $response->assertStatus(200);
        $response->assertViewIs('pets.edit');
        $response->assertViewHas('pet', $petData);
    }

    public function testUpdate()
    {
        $petData = [
            'id' => 1,
            'name' => 'Updated Dog',
            'status' => 'sold'
        ];

        $this->mock->shouldReceive('updatePet')->once()->with(Mockery::on(function ($arg) use ($petData) {
            return $arg['id'] == $petData['id'] && $arg['name'] == $petData['name'] && $arg['status'] == $petData['status'];
        }))->andReturn($petData);

        $response = $this->put('/pets/1', $petData);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
    }

    public function testDestroy()
    {
        $this->mock->shouldReceive('deletePet')->once()->with(1)->andReturn(true);

        $response = $this->delete('/pets/1');

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
    }
}
