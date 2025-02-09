<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">


    <!-- Include any additional stylesheets or scripts here -->
</head>

<body>

    <!-- Header -->
    <header>
        <h1>Film App</h1>
        <img src="{{ url('img/istockphoto-1302499179-612x612.jpg') }}" alt="Header" class="header-img">
    

    </header>

    <!-- Contenido dinámico -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <img src="{{ url('img/360_F_271506927_WWFfd92jDIIDx6DgMflakU14o5jRPgBm.jpg') }}" alt="Footer" class="footer-img">
    </footer>

</body>
</html>
