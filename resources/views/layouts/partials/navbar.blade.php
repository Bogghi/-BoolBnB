<nav class="navbar @if (Route::currentRouteName()  != 'homepage')
    nav-white
@endif navbar-expand-lg">
  <div class="@if (Route::currentRouteName() == 'homepage')
      container
  @else
      container-fluid
  @endif">
      {{-- logo --}}
      <div class="logo">
          <a href="{{ route('homepage') }}">
                @if (Route::currentRouteName() == 'homepage')
                    <img id="logo" src="{{ asset('img/boolbnb-logo-light.svg') }}" alt="BoolBnB">
                @else 
                    <img id="logo" src="{{ asset('img/boolbnb-logo-dark.svg') }}" alt="BoolBnB">
                @endif
          </a>
      </div>

      {{-- hamburger --}}
      <button class="navbar-toggler border border-dark text-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse mt-1" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav">

              <!-- Authentication Links  only admin is log-->
              @if (Route::currentRouteName() == 'admin.apartment.index')
                  <li class="nav-item zindex pl-2">
                      <a class="nav-link @if(Route::currentRouteName() != 'homepage') blue @endif" href="{{ route('admin.apartment.create') }}">Create a new apartment</a>
                  </li>
              @endif
              <!-- Authentication Links  only admin is log-->
              @if (Route::currentRouteName() != 'homepage')
                  <li class="nav-item zindex pl-2">
                      <a class="nav-link @if(Route::currentRouteName() != 'homepage') blue @endif" href="{{ route('homepage') }}">Home</a>
                  </li>
              @endif

              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item zindex pl-2">
                      <a id="navbarDropdown" class="nav-link @if(Route::currentRouteName() != 'homepage') blue @endif dropdown-toggle" href="#" role="button"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      {{-- dropdown menu --}}
                      <div class="dropdown-menu mr-5 mb-5 drop-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('admin.apartment.index') }}">Your apartments</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>