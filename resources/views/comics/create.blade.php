@extends('layout.main')

@section('content')

<main class="container">

  <div class="row">
    <div class="col-8 offset-2">

      <h1 class="mb-3">CREATE</h1>
  
      <form action="{{ route('comics.store') }}" method="POST">
        {{-- @csfr è un token univoco che genera Laravel per assicurarsi che la chiamata POST avvenga tramite un form del sito --}}
        @csrf

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
          type="text" 
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