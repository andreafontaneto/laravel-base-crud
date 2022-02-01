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
           {{-- aggiungiamo dentro class="" un @error per aggiungere la classe is-invalid --}}
           {{-- la classe "is-invalid" colora il bordo del campo di rosso --}}
          class="form-control @error('title') is-invalid @enderror" 
          id="title" 
          name="title" 
          placeholder="Comic title">
          {{-- @error è un @if --}}
          {{-- se esiste l'errore di 'title'... --}}
          @error('title')
              {{-- ...stampa un <p> (con la MIA classe "form_errors" fatta in app.scss) --}}
            <p class="form_errors">
              {{-- in automatico @error genera una variabile $message che stamperà il messaggio di errore --}}
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input 
          type="text" 
          class="form-control @error('image') is-invalid @enderror" 
          id="image" 
          name="image"
          placeholder="URL image">
          @error('image')
            <p class="form_errors">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input 
          type="number"
          step=0.01 
          class="form-control @error('price') is-invalid @enderror" 
          id="price" 
          name="price"
          placeholder="Comic price">
          @error('price')
            <p class="form_errors">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="series" class="form-label">Series</label>
          <input 
          type="text" 
          class="form-control @error('series') is-invalid @enderror" 
          id="series" 
          name="series"
          placeholder="Comic series">
          @error('series')
            <p class="form_errors">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="sales_date" class="form-label">Sales Date</label>
          <input 
          type="date" 
          class="form-control @error('sales_date') is-invalid @enderror" 
          id="sales_date" 
          name="sales_date"
          placeholder="Comic sales date">
          @error('sales_date')
            <p class="form_errors">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Type</label>
          <input 
          type="text" 
          class="form-control @error('type') is-invalid @enderror" 
          id="type" 
          name="type"
          placeholder="Comic type">
          @error('type')
            <p class="form_errors">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea 
          row="3"
          {{-- @error nella classe non c'è perchè la descrizione non è obbligatoria --}}
          class="form-control" 
          id="description" 
          name="description"
          placeholder="Comic description"></textarea>
          {{-- @error nella textarea non c'è perchè la descrizione non è obbligatoria --}}
        </div>

        <button type="submit" class="mb-3 btn btn-primary">Submit</button>
        <button type="reset" class="mb-3 btn btn-secondary">Reset</button>
      
      </form>

    </div>
  </div>

</main>
  
@endsection