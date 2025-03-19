@extends("master")

@section('content')

    <h1>{{$title}}</h1>

    @if($actorNumber == 0)
        <FONT COLOR="red">No se ha encontrado ningún actor</FONT>
    @else
        <p>Número de actores: {{$actorNumber}}</p>
    @endif
    
@endsection