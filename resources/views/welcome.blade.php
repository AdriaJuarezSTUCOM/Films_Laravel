<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">
    
        <div>
            <h1 class="mt-4">Lista de Peliculas</h1>
            <ul>
                <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
                <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
                <li><a href=/filmout/films>Pelis</a></li>
                <li><a href=/filmout/sortFilms>Pelis ordenadas por año descendiente</a></li>
                <li><a href=/filmout/countFilms>Contar pelis</a></li>
            </ul>
        </div>
        <div>
            <h1 class="mt-4">Insertar Películas</h1>
            @if (!empty($status))
                <p style="color:red;">{{$status}}</p>
            @endif
            <form action="{{route("/filmin/createFilm")}}" method="POST">
                {{crsf_field()}}
                Nombre: <input type="text" name="filmName" id="filmName" placeholder="Film Name"><br>
                Año: <input type="text" name="filmYear" id="filmYear" placeholder="Film Year"><br>
                País: <input type="text" name="filmCountry" id="filmCountry" placeholder="Film Country"><br>
                Duración: <input type="text" name="filmDuration" id="filmNamDurationlaceholder" placeholder="Film Duration"><br>
                Imagen URL: <input type="text" name="filmUrl" id="filmUrl" placeholder="Film Url"><br>
                <button type="submit">Enviar</button>
            </form>
        </div>


    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>

</html>
