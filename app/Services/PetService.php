<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetService
{
    private string $baseUrl = 'https://petstore.swagger.io/v2';

    public function fetchPetsByStatus(string $status): array
    {
        $response = Http::get("{$this->baseUrl}/pet/findByStatus", [
            'status' => $status
        ]);

        return $response->failed() ? [] : $response->json();
    }

    public function fetchPetById(int $id): array
    {
        $response = Http::get("{$this->baseUrl}/pet/{$id}");

        if ($response->failed()) {
            throw new \Exception('Pet not found', 404);
        }

        $pet = $response->json();
        $pet['category'] ??= ['name' => 'N/A'];

        return $pet;
    }

    public function createPet(array $data): array
    {
        $response = Http::post("{$this->baseUrl}/pet", $data);

        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'An error occurred', $response->status());
        }

        return $response->json();
    }

    public function updatePet(array $data): array
    {
        $response = Http::put("{$this->baseUrl}/pet", $data);

        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'An error occurred', $response->status());
        }

        return $response->json();
    }

    public function deletePet(int $id): bool
    {
        $response = Http::delete("{$this->baseUrl}/pet/{$id}");

        if ($response->failed()) {
            throw new \Exception($response->json()['message'] ?? 'An error occurred', $response->status());
        }

        return true;
    }
}
