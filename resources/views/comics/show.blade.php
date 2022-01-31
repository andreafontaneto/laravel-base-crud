@extends('layout.main')

@section('content')

<div class="container">

  <h1 class="mb-3">{{ $comic->title }}</h1>
  
  <div class="my-3 d-flex">
    {{-- EDIT BUTTON --}}
    <a class="mr-3 btn btn-primary" href="{{ route('comics.edit', $comic) }}">EDIT</a>
    {{-- DELETE BUTTON --}}
    <form action="{{ route('comics.destroy', $comic) }}" method="POST">
      @csrf
      {{-- aggiungiamo il metodo DELETE tramite Blade
      {{-- chiamerà il metodo "destroy"(passandogli il parametro necessario) --}}
      @method('DELETE')
      {{-- il link "a" diventa un "button" con "submit" quindi senza "href" --}}
      <button type="submit" class="btn btn-danger">DELETE</button>
    </form>
  </div>

  <div class="row">
    <div class="col-6">
      <img class="img-fluid mb-5 pr-5" src="{{ $comic->image }}" alt="{{ $comic->title }}">
    </div>
  
    <div class="col-6 mb-3">
      <h5>Serie originale: {{ $comic->series }}</h4>
      <h5>In vendita dal: {{ $comic->sales_date }}</h5>
      <h3>Prezzo: {{ $comic->price }}€</h3>
    </div>
  </div>

  <div>
    <p>{{ $comic->description }}</p>

    {{-- se la description contenesse tag html bisogna scrivere {!! + testo + !!} --}}
    {{-- <p>{!! $comic->description !!}</p> --}} 

  </div>

  {{-- BACK BUTTON --}}
  <a class="my-5" href="{{route('comics.index')}}"> <<-BACK </a>

</div>
  
@endsection