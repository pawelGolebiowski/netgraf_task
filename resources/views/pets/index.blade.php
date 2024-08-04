@extends('layouts.app')

@section('content')
    <h1>Pets</h1>
    <form id="statusForm" method="GET" action="{{ url('pets') }}">
        <div class="form-group">
            <label for="status">Select Status:</label>
            <select id="status" name="status" class="form-control">
                <option value="available" {{ $status === 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ $status === 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Filter</button>
    </form>

    <a href="{{ route('pets.create') }}" class="btn btn-primary">Add New Pet</a>

    @include('components.list', ['pets' => $pets])
@endsection
