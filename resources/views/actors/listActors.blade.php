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
                    @foreach(array_keys($actor) as $key)
                        <th>{{$key}}</th>
                    @endforeach
                    @break
                @endforeach
            </tr>

            @foreach($actors as $actor)
                <tr>
                    <td>{{$actor['name']}}</td>
                    <td>{{$actor['year']}}</td>
                    <td>{{$actor['genre']}}</td>
                    <td><img src={{$actor['img_url']}} style="width: 100px; height: 120px;" /></td>
                    <td>{{$actor['country']}}</td>
                    <td>{{$actor['duration']}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
@endsection