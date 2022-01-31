@extends('layout.main')

@section('content')

<main class="container ">

  <div class="d-flex flex-column justify-content-center align-items-center">
    <h1>ERRORE 404! :( </h1>
    <h3>Prodotto non trovato</h3>
    <p>{{ $exception->getMessage() }}</p>
  </div>

</main>
  
@endsection