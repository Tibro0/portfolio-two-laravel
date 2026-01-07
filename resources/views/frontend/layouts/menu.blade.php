<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
        <nav id="navmenu" class="navmenu">
            <div class="profile-img">
                <img src="{{ asset(@$user->avatar) }}" alt=""
                    class="img-fluid rounded-circle" />
            </div>

            <a href="index.html" class="logo d-flex align-items-center justify-content-center active">
                <h1 class="sitename">{{ @$user->name }}</h1>
            </a>
            <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#resume">Resume</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
