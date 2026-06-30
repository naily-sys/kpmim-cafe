<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Café</title>

    @vite([
        'resources/css/app.css',
        'resources/css/owner-select.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="container">

    <div class="logo">☕</div>

    <h1>Select Your Café</h1>

    <p class="subtitle">
        Choose the café you manage to continue.
    </p>

    <div class="grid">

        @for ($i = 1; $i <= 6; $i++)

            <a href="{{ route('owner.login') }}?cafe_id={{ $i }}"
               class="cafe-btn">


                <div class="cafe-name">
                    Café {{ $i }}
                </div>

            </a>

        @endfor

    </div>

    <a href="/" class="back-home">
        ← Back to Home
    </a>

</div>

</body>
</html>