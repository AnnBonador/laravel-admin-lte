<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdow user-menu">
            <!-- Messages Dropdown Menu -->
            <div class="btn-group">

                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static"
                    aria-expanded="false">
                    <img src="{{ asset('admin-assets/dist/img/user2-160x160.jpg') }}"
                        class="user-image img-circle elevation-2" alt="User Image">
                    {{ Auth::user()->fname }}
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a href="" class="dropdown-item">Profile</a></li>
                    <li><a href="" class="dropdown-item">Change Password</a></li>
                    <li><a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
