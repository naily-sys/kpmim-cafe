<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>

    @vite([
        'resources/css/app.css',
        'resources/css/manage-menu.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="container">

    <a href="{{ route('owner.dashboard') }}" class="back">
        ← Back to Dashboard
    </a>

    <div class="header">

        <div>
            <h1 class="title">
                {{ $cafe->name }} Menu
            </h1>

            <p class="subtitle">
                Manage your food and beverages
            </p>
        </div>

        <a href="{{ route('owner.menu.create') }}" class="btn-add">
            + Add Item
        </a>

    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($menuItems as $item)

                    <tr>

                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}"
                                     class="item-img">
                            @else
                                <div class="no-img">🍽️</div>
                            @endif
                        </td>

                        <td>
                            <strong>{{ $item->name }}</strong>
                        </td>

                        <td>
                            {{ $item->description ?? '-' }}
                        </td>

                        <td>
                            RM {{ number_format($item->price, 2) }}
                        </td>

                        <td>
                            <span class="badge badge-{{ $item->category }}">
                                {{ ucfirst($item->category) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge {{ $item->is_available ? 'badge-available' : 'badge-unavailable' }}">
                                {{ $item->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>

                        <td>

                            <div class="actions">

                                <a href="{{ route('owner.menu.edit', ['menuItem' => $item->id]) }}"
                                   class="btn-edit">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('owner.menu.destroy', ['menuItem' => $item->id]) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-delete"
                                            onclick="return confirm('Delete this item?')">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty">
                            No menu items yet. Add your first item!
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>