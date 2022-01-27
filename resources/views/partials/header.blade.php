<header class="container py-3 mb-5">

  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link @if (Route::currentRouteName() === 'home') 'active' @endif " aria-current="page" href="{{ route('home') }}">HOME</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (Route::currentRouteName() === 'comics.index') 'active' @endif " href="{{ route('comics.index') }}">COMICS LIST</a>
    </li>
  </ul>

</header>