@extends("master")

@section('content')
    <h1>{{$title}}</h1>
    @if(empty($actors))
        <FONT COLOR="red">No se ha encontrado ningún actor</FONT>
    @else
        <div class="tableContainer">
        <table border="1" class="table">
            <tr>
                @foreach($actors as $actor)
                    @foreach(array_keys((array) $actors[0]) as $key)
                        <th>{{ ucfirst($key) }}</th>
                    @endforeach
                    @break
                @endforeach
            </tr>

            @foreach($actors as $actor)
                <tr>
                    <td>{{$actor->name}}</td>
                    <td>{{$actor->surname}}</td>
                    <td>{{$actor->birthdate}}</td>
                    <td>{{$actor->country}}</td>
                    <td><img src={{$actor->img_url}} style="width: 100px; height: 120px;" /></td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
@endsection