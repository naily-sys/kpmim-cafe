<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>

    @vite([
        'resources/css/app.css',
        'resources/css/owner-menu-edit.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="card">

    <h1 class="title">Edit Menu Item</h1>

    <p class="subtitle">
        Update your food or beverage details
    </p>

    <form method="POST"
          action="{{ route('owner.menu.update', $menuItem) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Item Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $menuItem->name) }}"
                required
            >

            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Description (Optional)</label>

            <textarea
                name="description"
                rows="4"
            >{{ old('description', $menuItem->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Price (RM)</label>

            <input
                type="number"
                name="price"
                step="0.01"
                min="0"
                value="{{ old('price', $menuItem->price) }}"
                required
            >

            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Category</label>

            <select name="category" required>
                <option value="food"
                    {{ $menuItem->category == 'food' ? 'selected' : '' }}>
                    Food
                </option>

                <option value="beverage"
                    {{ $menuItem->category == 'beverage' ? 'selected' : '' }}>
                    Beverage
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Availability</label>

            <select name="is_available">
                <option value="1"
                    {{ $menuItem->is_available ? 'selected' : '' }}>
                    Available
                </option>

                <option value="0"
                    {{ !$menuItem->is_available ? 'selected' : '' }}>
                    Unavailable
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Current Image</label>

            @if($menuItem->image)
                <img
                    src="{{ asset('storage/' . $menuItem->image) }}"
                    class="current-img"
                    id="currentImg"
                >
            @endif

            <img id="preview" class="image-preview">

            <input
                type="file"
                name="image"
                accept="image/*"
                onchange="previewImage(this)"
            >

            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">
            Update Item
        </button>

    </form>

    <div class="links">

        <a href="{{ route('owner.menu.index') }}"
           class="back-link">
            ← Back to Menu
        </a>

        <a href="{{ route('owner.dashboard') }}"
           class="back-link">
            Back to Dashboard
        </a>

    </div>

</div>

<script>
function previewImage(input)
{
    const preview = document.getElementById('preview');
    const current = document.getElementById('currentImg');

    if(input.files && input.files[0])
    {
        const reader = new FileReader();

        reader.onload = function(e)
        {
            preview.src = e.target.result;
            preview.style.display = 'block';

            if(current)
            {
                current.style.display = 'none';
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>