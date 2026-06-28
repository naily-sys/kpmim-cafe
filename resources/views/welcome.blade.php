<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMIM Café Ordering System</title>

    @vite([
        'resources/css/app.css',
        'resources/css/welcome.css',
        'resources/js/app.js'
    ])
</head>
<body>

    <div class="container">
        <div class="card">

            <div class="logo">☕</div>

            <h1>KPMIM Café Ordering System</h1>

            <p class="subtitle">
                Welcome! Please select who you are!
            </p>

            <div class="buttons">
                <a href="{{ route('customer.login') }}"
                   class="btn btn-customer">
                    Customer
                </a>

                <a href="{{ route('owner.select') }}"
                   class="btn btn-owner">
                    Café Owner
                </a>
            </div>

        </div>
    </div>

</body>
</html>