@extends("master")

@section('content')

    <h1>{{$title}}</h1>

    @if($filmNumber == 0)
        <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
    @else
        <p>Número de películas: {{$filmNumber}}</p>
    @endif
    
@endsection