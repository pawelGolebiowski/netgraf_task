<form action="{{ $action }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="id">ID:</label>
        <input type="number" id="id" name="id" class="form-control" value="{{ old('id', $pet['id'] ?? '') }}" required>
    </div>
    <div class="form-group">
        <label for="category_id">Category ID:</label>
        <input type="number" id="category_id" name="category_id" class="form-control" value="{{ old('category_id', $pet['category']['id'] ?? '') }}">
    </div>
    <div class="form-group">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" class="form-control" value="{{ old('category_name', $pet['category']['name'] ?? '') }}">
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $pet['name'] ?? '') }}" required>
    </div>
    <div class="form-group">
        <label for="photoUrls">Photo URLs (comma separated):</label>
        <input type="text" id="photoUrls" name="photoUrls" class="form-control" value="{{ old('photoUrls', is_array($pet['photoUrls'] ?? null) ? implode(',', $pet['photoUrls']) : '') }}">
    </div>
    <div class="form-group">
        <label for="tags">Tags (comma separated):</label>
        <input type="text" id="tags" name="tags" class="form-control" value="{{ old('tags', is_array($pet['tags'] ?? null) ? implode(',', array_column($pet['tags'], 'name')) : '') }}">
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select id="status" name="status" class="form-control" required>
            <option value="available" {{ old('status', $pet['status'] ?? '') === 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ old('status', $pet['status'] ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ old('status', $pet['status'] ?? '') === 'sold' ? 'selected' : '' }}>Sold</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">{{ $method === 'PUT' ? 'Update' : 'Add' }} Pet</button>
</form>
