<nav class="navigation navbar navbar-expand-md navbar-light shadow-sm sticky-top">
    <div class="container-fluid px-3 px-sm-5">
        <div class="logo-box">
            <a class="navbar-brand text-uppercase text-white" href="{{ url('/') }}">
                {{ config('app.name', 'Upvote') }}
            </a>
        </div>

        <div class="d-none d-md-block">
            @include('partials._sub-nav')
        </div>

        <div class="flex-grow-0">
            <ul class="nav align-items-center">
                <li class="nav__item">
                    <a href="#searchBox" data-toggle="modal"><i
                            class="fas fa-search search-icon"></i></a>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white pr-0" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ Auth::user()->avatar_path }}" alt="{{ Auth::user()->name }}" width="26"
                                 height="26" class="rounded-circle"> <span class="caret"></span>
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

    <div class="d-block d-md-none w-100">
        @include('partials._sub-nav')
    </div>
</nav>
