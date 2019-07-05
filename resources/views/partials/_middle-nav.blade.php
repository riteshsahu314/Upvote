<ul class="d-flex nav mb-0">
    <li class="nav__item nav__item--active px-5">
        <a href="/">
{{--            <i class="fas fa-home nav__item__icon"></i>--}}
            <span class="nav__item__text">Home</span>
        </a>
    </li>

    <li class="nav__item px-5">
        <a href="{{ route('questions.index') }}">
{{--            <i class="fas fa-question nav__item__icon"></i>--}}
            <span class="nav__item__text">Questions</span>
        </a>
    </li>

    <li class="nav__item px-5">
        <a href="{{ route('users.index') }}">
{{--            <i class="fas fa-user nav__item__icon"></i>--}}
            <span class="nav__item__text">Users</span>
        </a>
    </li>

    <li class="nav__item px-5">
        <a href="{{ route('tags.index') }}">
{{--            <i class="fas fa-tag nav__item__icon"></i>--}}
            <span class="nav__item__text">Tags</span>
        </a>
    </li>
</ul>
