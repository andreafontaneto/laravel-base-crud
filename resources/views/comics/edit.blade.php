@extends('layout.main')

@section('content')

<main class="container">

  <div class="row">
    <div class="col-8 offset-2">

      {{-- REPLICHIAMO TUTTA LA VALIDAZIONE CON GLI ALERT PER GLI ERRORI --}}

      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>  
      @endif

      <h1 class="mb-3">{{ $comic->title }}</h1>
  
      <form action="{{ route('comics.update', $comic) }}" method="POST">
        {{-- @csfr è un token univoco che genera Laravel per assicurarsi che la chiamata POST avvenga tramite un form del sito --}}
        @csrf

        {{-- aggiungiamo il metodo PUT tramite Blade
        {{-- chiamerà il metodo "update"(passandogli il parametro necessario) --}}
        @method('PUT')

        {{-- il name del'input deve corrispondere al nome della colonna fatta nel DB --}}
        {{-- il value è il "testo/valore" da modificare --}}
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input 
          type="text" 
          class="form-control @error('title') is-invalid @enderror" 
          id="title" 
          name="title"
          {{-- nel value aggiungo old() che accetta 2 parametri --}}
          {{-- il primo è il valore in sessione --}}
          {{-- se non trova il primo ('title') allora stampa il secondo ($comic->title) --}}
          value="{{ old('title', $comic->title) }}"
          placeholder="Comic title">
          @error('title')
            <p class="form_errors">
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
          value="{{ old('image', $comic->image) }}"
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
          value="{{ old('price', $comic->price) }}"
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
          value="{{ old('series', $comic->series) }}"
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
          value="{{ old('sales_date', $comic->sales_date) }}"
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
          value="{{ old('type', $comic->type) }}"
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
          class="form-control" 
          id="description" 
          name="description"
          {{-- la textarea non ha il value come proprietà, ma come campo! --}}
          {{-- ma ci aggiungiamo anche qui il metodo old() --}}
          placeholder="Comic description">{{ old('description', $comic->description) }}</textarea>
        </div>

        <button type="submit" class="mb-3 btn btn-primary">Submit</button>
        <button type="reset" class="mb-3 btn btn-secondary">Reset</button>
      
      </form>

    </div>
  </div>

</main>
  
@endsection