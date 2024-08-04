<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\PetData;
use App\Services\PetService;
use Illuminate\Http\Request;
use App\Http\Requests\PetRequest;

class PetController extends Controller
{
    public function __construct(private PetService $petApiService) {}

    public function index(Request $request)
    {
        $status = $request->query('status', 'available');
        $pets = $this->petApiService->fetchPetsByStatus($status);

        if ($request->ajax()) {
            return view('components.list', ['pets' => $pets]);
        }

        return view('pets.index', compact('pets', 'status'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(PetRequest $request)
    {
        try {
            $petData = PetData::fromArray($request->validated());
            $this->petApiService->createPet($petData->toArray());
            return redirect('/')->with('success', 'Pet added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function show(int $id)
    {
        try {
            $pet = $this->petApiService->fetchPetById($id);
            return view('pets.show', compact('pet'));
        } catch (\Exception $e) {
            abort(404, 'Pet not found');
        }
    }

    public function edit(int $id)
    {
        try {
            $pet = $this->petApiService->fetchPetById($id);
            return view('pets.edit', compact('pet'));
        } catch (\Exception $e) {
            abort(404, 'Pet not found');
        }
    }

    public function update(PetRequest $request, int $id)
    {
        try {
            $petData = PetData::fromArray($request->validated());
            $petData->id = $id;
            $this->petApiService->updatePet($petData->toArray());
            return redirect('/')->with('success', 'Pet updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->petApiService->deletePet($id);
            return redirect('/')->with('success', 'Pet deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
