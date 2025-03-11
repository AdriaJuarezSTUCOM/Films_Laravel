@extends("master")

@section('content')
    
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
            <form action="{{route("createFilm")}}" method="POST">
                {{csrf_field()}}
                Nombre: <input type="text" name="name" id="name" placeholder="Film Name"><br>
                Año: <input type="number" name="year" id="year" placeholder="Film Year"><br>
                Género: <input type="text" name="genre" id="genre" placeholder="Film Genre"><br>
                País: <input type="text" name="country" id="country" placeholder="Film Country"><br>
                Duración: <input type="number" name="duration" id="duration" placeholder="Film Duration"><br>
                Imagen URL: <input type="url" name="img_url" id="img_url" placeholder="image Url"><br>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <div>
            <h1 class="mt-4">Lista de actores</h1>
            <ul>
                <li><a href=/actorout/actors>Actores</a></li>
                <li><a href=/actorout/countActors>Contador de actores</a></li>
            </ul>
        </div>
        <div>
            <h1 class="mt-4">Búsqueda de actores</h1>
            <ul>
                <label>Selecciona la década:</label>
                <select name="" id="">
                    <option value="">1980-1989</option>
                    <option value="">1990-1999</option>
                    <option value="">2000-2009</option>
                    <option value="">2010-2019</option>
                </select>
                <button type="submit">Enviar</button>
            </ul>
        </div>

    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

@endsection