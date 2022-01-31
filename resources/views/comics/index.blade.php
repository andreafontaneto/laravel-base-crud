@extends('layout.main')

@section('content')

{{-- @dump($comics); --}}

<div class="container">

  <h1>HOME CRUD - comic list</h1>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">TITOLO</th>
        <th scope="col">SERIE</th>
        <th scope="col">PREZZO</th>
        <th colspan="3" scope="col">AZIONI</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach ($comics as $comic)
        <tr>
          <th scope="row">{{ $comic->id }}</th>
          <td>{{ $comic->title }}</td>
          <td>{{ $comic->series }}</td>
          <td>{{ $comic->price }}</td>
          <td><a class="btn btn-success" href="{{route('comics.show', $comic)}}">SHOW</a></td>
          <td><a class="btn btn-primary" href="">EDIT</a></td>
          <td><a class="btn btn-danger" href="">DELETE</a></td>
        </tr>    
      @endforeach
      
    </tbody>
  </table>

</div>

<div class="container">
  {{ $comics->links() }}
</div>
  
@endsection