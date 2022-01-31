@extends('layout.main')

@section('content')

<main class="container">

  <div class="row">
    <div class="col-8 offset-2">

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
          class="form-control" 
          id="title" 
          name="title"
          value="{{ $comic->title }}"
          placeholder="Comic title">
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input 
          type="text" 
          class="form-control" 
          id="image" 
          name="image"
          value="{{ $comic->image }}"
          placeholder="URL image">
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input 
          type="number" 
          class="form-control" 
          id="price" 
          name="price"
          value="{{ $comic->price }}"
          placeholder="Comic price">
        </div>
        <div class="mb-3">
          <label for="series" class="form-label">Series</label>
          <input 
          type="text" 
          class="form-control" 
          id="series" 
          name="series"
          value="{{ $comic->series }}"
          placeholder="Comic series">
        </div>
        <div class="mb-3">
          <label for="sales_date" class="form-label">Sales Date</label>
          <input 
          type="date" 
          class="form-control" 
          id="sales_date" 
          name="sales_date"
          value="{{ $comic->sales_date }}"
          placeholder="Comic sales date">
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Type</label>
          <input 
          type="text" 
          class="form-control" 
          id="type" 
          name="type"
          value="{{ $comic->type }}"
          placeholder="Comic type">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea 
          row="3"
          class="form-control" 
          id="description" 
          name="description"
          {{-- la textarea non ha il value come proprietà, ma come campo! --}}
          placeholder="Comic description">{{ $comic->description }}</textarea>
        </div>

        <button type="submit" class="mb-3 btn btn-primary">Submit</button>
        <button type="reset" class="mb-3 btn btn-secondary">Reset</button>
      
      </form>

    </div>
  </div>

</main>
  
@endsection