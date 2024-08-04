@extends('layouts.app')

@section('content')
    <h1>{{ $pet['name'] }}</h1>
    <div class="pet-details">
        <p><strong>Status:</strong> {{ $pet['status'] }}</p>
        <p><strong>Category:</strong> {{ $pet['category']['name'] ?? 'N/A' }}</p>
        <p><strong>Photo URLs:</strong> {{ implode(', ', $pet['photoUrls'] ?? []) }}</p>
        <p><strong>Tags:</strong> {{ implode(', ', array_column($pet['tags'] ?? [], 'name')) }}</p>
    </div>
    <div class="pet-actions">
        <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-primary">Edit Pet</a>
        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Pet</button>
        </form>
    </div>
@endsection
