<nav class="navbar navbar-expand-lg header-nav">
    <div class="navbar-header">
        <a id="mobile_btn" href="javascript:void(0);">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
        <a href="{{ route('home.page') }}" class="navbar-brand logo">
            <img src="{{ asset('uploads/setting/' . logo()) }}" class="img-fluid" width="50%" alt="Logo">
        </a>
    </div>
    <div class="main-menu-wrapper">
        <div class="menu-header">
            <a href="index-2.html" class="menu-logo">
                <img src="{{ asset('uploads/setting/' . logo()) }}" class="img-fluid" alt="Logo">
            </a>
            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <ul class="main-nav">
            <li class="active">
                <a href="{{ route('home.page') }}">Home</a>
            </li>
            <li class="has-submenu">
                <a href="#">Search Results <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="{{ route('doctor.search') }}">Search Dentist</a></li>
                    <li><a href="{{ route('clinics.search') }}">Search Clinics</a></li>
                </ul>
            </li>
            <li class="login-link">
                <a href="{{ route('login') }}">Login / Signup</a>
            </li>
        </ul>
    </div>
    <ul class="nav header-navbar-rht">
        <li class="nav-item contact-item">
            <div class="header-contact-img">
                <i class="far fa-hospital"></i>
            </div>
            <div class="header-contact-detail">
                <p class="contact-header">Contact</p>
                <p class="contact-info-header"> {{ contact() }}</p>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link header-login" href="{{ route('login') }}">login / Signup </a>
        </li>
    </ul>
</nav>
