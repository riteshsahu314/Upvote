<ul class="d-flex nav mb-0">
    <li class="nav__item px-5 {{ Request::is('/') ? 'nav__item--active' : '' }}">
        <a href="/">
{{--            <i class="fas fa-home nav__item__icon"></i>--}}
            <span class="nav__item__text">Home</span>
        </a>
    </li>

    <li class="nav__item px-5 {{ Request::is('questions') || Request::is('questions/*') ? 'nav__item--active' : '' }}">
        <a href="{{ route('questions.index') }}">
{{--            <i class="fas fa-question nav__item__icon"></i>--}}
            <span class="nav__item__text">Questions</span>
        </a>
    </li>

    <li class="nav__item px-5 {{ Request::is('users') || Request::is('users/*') ? 'nav__item--active' : '' }}">
        <a href="{{ route('users.index') }}">
{{--            <i class="fas fa-user nav__item__icon"></i>--}}
            <span class="nav__item__text">Users</span>
        </a>
    </li>

    <li class="nav__item px-5 {{ Request::is('tags') || Request::is('tags/*') ? 'nav__item--active' : '' }}">
        <a href="{{ route('tags.index') }}">
{{--            <i class="fas fa-tag nav__item__icon"></i>--}}
            <span class="nav__item__text">Tags</span>
        </a>
    </li>
</ul>
