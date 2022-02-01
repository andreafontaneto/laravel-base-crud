@extends('layout.main')

@section('content')

{{-- per leggere gli errori generati dal metodo validate nel controller --}}
{{-- @dump($errors->all()) --}}

<main class="container">

  <div class="row">
    <div class="col-8 offset-2">

      {{-- SE c'è qualche (any) errore stampa l'alert --}}
      {{-- any() restituisce true o false --}}
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          {{-- l'alert sarà l'errore generato dalla validazione impostata sul ComicController --}}
          <ul>
            {{-- per ogni errore ($error) nell'array ($errors->all())... --}}
            @foreach ($errors->all() as $error)
              {{-- ...stampa l'errore --}}
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>  
      @endif

      <h1 class="mb-3">CREATE</h1>
  
      <form action="{{ route('comics.store') }}" method="POST">
        {{-- @csfr è un token univoco che genera Laravel per assicurarsi che la chiamata POST avvenga tramite un form del sito --}}
        @csrf

        {{-- il name del'input deve corrispondere al nome della colonna fatta nel DB --}}
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input 
          type="text" 
          class="form-control" 
          id="title" 
          name="title" 
          placeholder="Comic title">
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input 
          type="text" 
          class="form-control" 
          id="image" 
          name="image"
          placeholder="URL image">
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input 
          type="number"
          step=0.01 
          class="form-control" 
          id="price" 
          name="price"
          placeholder="Comic price">
        </div>
        <div class="mb-3">
          <label for="series" class="form-label">Series</label>
          <input 
          type="text" 
          class="form-control" 
          id="series" 
          name="series"
          placeholder="Comic series">
        </div>
        <div class="mb-3">
          <label for="sales_date" class="form-label">Sales Date</label>
          <input 
          type="date" 
          class="form-control" 
          id="sales_date" 
          name="sales_date"
          placeholder="Comic sales date">
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Type</label>
          <input 
          type="text" 
          class="form-control" 
          id="type" 
          name="type"
          placeholder="Comic type">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea 
          row="3"
          class="form-control" 
          id="description" 
          name="description"
          placeholder="Comic description"></textarea>
        </div>

        <button type="submit" class="mb-3 btn btn-primary">Submit</button>
        <button type="reset" class="mb-3 btn btn-secondary">Reset</button>
      
      </form>

    </div>
  </div>

</main>
  
@endsection