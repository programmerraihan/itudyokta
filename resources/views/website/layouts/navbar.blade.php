<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('website.home', ['branch' => request()->branch ?? 'main']) }}">ItUdyokta</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.home') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('website.home', ['branch' => request()->branch ?? 'main']) }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.about') ? 'active' : '' }}"
                        href="{{ route('website.about', ['branch' => request()->branch ?? 'main']) }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.course') ? 'active' : '' }}"
                        href="{{ route('website.course', ['branch' => request()->branch ?? 'main']) }}">Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.admission') ? 'active' : '' }}"
                        href="{{ route('website.admission', ['branch' => request()->branch ?? 'main']) }}">Admission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.online-exam') ? 'active' : '' }}"
                        href="{{ route('website.online-exam', ['branch' => request()->branch ?? 'main']) }}">Online Exam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.result') ? 'active' : '' }}"
                        href="{{ route('website.result', ['branch' => request()->branch ?? 'main']) }}">Result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.centerRegistration') ? 'active' : '' }}"
                        href="{{ route('website.centerRegistration', ['branch' => request()->branch ?? 'main']) }}">Center Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.blog') ? 'active' : '' }}"
                        href="{{ route('website.blog', ['branch' => request()->branch ?? 'main']) }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('website.contactUs') ? 'active' : '' }}"
                        href="{{ route('website.contactUs', ['branch' => request()->branch ?? 'main']) }}">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
