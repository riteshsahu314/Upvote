<nav class="main-nav navbar navbar-expand-md navbar-light shadow-sm sticky-top p-0">
    <div class="container-fluid px-5">
        <a class="navbar-brand text-uppercase text-white" href="{{ url('/') }}">
            {{ config('app.name', 'Upvote') }}
        </a>


        <div class="d-none d-md-block">
            @include('partials._middle-nav')
        </div>


        <div class="d-md-none">
            <div class="d-flex align-items-center">
                <a href="#searchBox" data-toggle="modal" class="text-decoration-none"><i
                        class="fas fa-search search-icon nav-link"></i></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a href="#searchBox" data-toggle="modal"><i
                            class="fas fa-search search-icon p-2"></i></a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav__item">
                        <a class="nav__item__text" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav__item">
                            <a class="nav__item__text" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <user-notifications></user-notifications>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ Auth::user()->avatar_path }}" alt="{{ Auth::user()->name }}" width="30"
                                 height="30" class="rounded-circle"> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow border" aria-labelledby="navbarDropdown">
                            <a href="{{ route('users.show', Auth::user()) }}" class="dropdown-item">My Profile</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
