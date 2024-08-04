@extends('layouts.app')

@section('content')
    <h1>Add New Pet</h1>
    @include('components.form', ['action' => route('pets.store'), 'method' => 'POST', 'pet' => null])
@endsection
