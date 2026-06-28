<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>

    @vite([
        'resources/css/app.css',
        'resources/css/owner-menu-create.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="card">

    <h1 class="title">Add Menu Item</h1>

    <p class="subtitle">
        Add a new food or beverage to your café menu
    </p>

    <form method="POST"
          action="{{ route('owner.menu.store') }}"
          enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label>Item Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
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
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Price (RM)</label>

            <input
                type="number"
                name="price"
                step="0.01"
                min="0"
                value="{{ old('price') }}"
                required
            >

            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Category</label>

            <select name="category" required>
                <option value="">Select Category</option>

                <option value="food"
                    {{ old('category') == 'food' ? 'selected' : '' }}>
                    Food
                </option>

                <option value="beverage"
                    {{ old('category') == 'beverage' ? 'selected' : '' }}>
                    Beverage
                </option>
            </select>

            @error('category')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Item Image (Optional)</label>

            <img id="preview" class="image-preview">

            <input
                type="file"
                name="image"
                class="file-input"
                accept="image/*"
                onchange="previewImage(this)"
            >

            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">
            Add Item
        </button>

    </form>

    <div class="links">
        <a href="{{ route('owner.menu.index') }}" class="back-link">
            ← Back to Menu
        </a>

        <a href="{{ route('owner.dashboard') }}" class="back-link">
            Back to Dashboard
        </a>
    </div>

</div>

<script>
function previewImage(input)
{
    const preview = document.getElementById('preview');

    if(input.files && input.files[0])
    {
        const reader = new FileReader();

        reader.onload = function(e)
        {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>