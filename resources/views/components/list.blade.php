<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pets as $pet)
        <tr>
            <td>{{ $pet['id'] }}</td>
            <td>{{ $pet['name'] }}</td>
            <td>{{ $pet['status'] }}</td>
            <td>
                <a href="{{ route('pets.show', $pet['id']) }}" class="btn btn-primary btn-sm">View</a>
                <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
