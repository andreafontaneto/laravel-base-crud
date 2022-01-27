@extends('layout.main')

@section('content')

<div class="container">

  <h1 class="mb-3">{{ $comic->title }}</h1>

  <div class="d-flex align-items-center">
    <img class="mb-5 pr-5" src="{{ $comic->image }}" alt="{{ $comic->title }}">
  
    <div class="mb-3">
      <h5>Serie originale: {{ $comic->series }}</h4>
      <h5>In vendita dal: {{ $comic->sales_date }}</h5>
      <h3>Prezzo: {{ $comic->price }}€</h3>
    </div>
  </div>

  <div>
    <p>{{ $comic->description }}</p>
  </div>

</div>
  
@endsection