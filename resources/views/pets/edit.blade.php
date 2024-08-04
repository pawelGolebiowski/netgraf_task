@extends('layouts.app')

@section('content')
    <h1>Edit Pet</h1>
    @include('components.form', ['action' => route('pets.update', $pet['id']), 'method' => 'PUT', 'pet' => $pet])
@endsection
