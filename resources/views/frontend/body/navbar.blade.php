<nav class="navbar navbar-expand-lg navbar-light bg-light sticky">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ asset('frontend/assets/image/logo.png') }}">আইটি উদ্যোক্তা</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav  ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">
                        ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('course') ? 'active' : '' }}"
                        href="{{ url('/course') }}">COURSE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admission') ? 'active' : '' }}"
                        href="{{ url('/admission') }}">ADMISSION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('online-exam') ? 'active' : '' }} "
                        href="{{ url('/online-exam') }}">ONLINE EXAM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('result') ? 'active' : '' }} "
                        href="{{ route('result') }}">RESULT</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->is('center-registration') ? 'active' : '' }}"
                        href="{{ url('/center-registration') }}">CENTER REGISTRATION</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('blog') ? 'active' : '' }}" href="{{ url('/blog') }}">
                        BLOG</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">
                        CONTACT
                        US </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
