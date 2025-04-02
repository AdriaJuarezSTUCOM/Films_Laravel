@extends("master")

@section('content')
    <h1>{{$title}}</h1>
    @if(empty($films))
        <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
    @else
        <div class="tableContainer">
        <table border="1" class="table">
            <tr>
                @foreach($films as $film)
                    @foreach(array_keys($film->getAttributes()) as $key)
                        <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                    @endforeach
                    @break
                @endforeach
            </tr>

            @foreach($films as $film)
                <tr>
                    <td>{{$film->name}}</td>
                    <td>{{$film->year}}</td>
                    <td>{{$film->genre}}</td>
                    <td><img src={{$film->img_url}} style="width: 100px; height: 120px;" /></td>
                    <td>{{$film->country}}</td>
                    <td>{{$film->duration}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
@endsection