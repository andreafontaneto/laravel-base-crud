@extends('layout.main')

@section('content')

{{-- @dump($comics); --}}

{{-- per stampare tutte le informazioni presenti in sessione --}}
{{-- confermando l'eliminazione di un fumetto...
dichiaro che ESISTE (quindi è true) una variabile di sessione "deleted" (impostata sul ComicController) che quindi non è NULL e la visualizzerò (tramite dump) --}}
{{-- @dump(session()->all()); --}}

<div class="container">

  {{-- SE esiste la variabile di sessione "deleted" stampa l'alert --}}
  @if (session('deleted'))
    <div class="alert alert-danger" role="alert">
      {{-- l'alert sarà il messaggio impostato sul ComicController --}}
      {{session('deleted')}}
    </div>  
  @endif

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
          <td><a class="btn btn-primary" href="{{route('comics.edit', $comic)}}">EDIT</a></td>
          <td>
            {{-- devo usare il form con metodo DELETE perchè con un link normale invierei in GET --}}
            <form 
            onsubmit="return confirm('Confermi eliminazione di {{$comic->title}}?')"
            action="{{ route('comics.destroy', $comic) }}" method="POST">
              @csrf
              {{-- aggiungiamo il metodo DELETE tramite Blade
              {{-- chiamerà il metodo "destroy"(passandogli il parametro necessario) --}}
              @method('DELETE')
              {{-- il link "a" diventa un "button" con "submit" quindi senza "href" --}}
              <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
          </td>
        </tr>    
      @endforeach
      
    </tbody>
  </table>

</div>

<div class="container">
  {{ $comics->links() }}
</div>
  
@endsection