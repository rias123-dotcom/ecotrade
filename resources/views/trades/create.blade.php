<!doctype html><html><head><meta charset="utf-8"><title>Create Trade</title></head><body>
<h1>Create Trade</h1>
<form method="POST" action="{{ route('trades.store') }}">
    @csrf
    <label>Title</label><br><input type="text" name="title" required><br>
    <label>Category</label><br><input type="text" name="category" required><br>
    <label>Description</label><br><textarea name="description"></textarea><br>
    <button type="submit">Create</button>
</form>
</body></html>
