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
                    @role('Super-Admin')
                        @if (!empty(Auth::user()->image))
                            <img src="{{ asset('uploads/admin/' . Auth::user()->image) }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('admin-assets/dist/img/male.png') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @endif
                    @endrole
                    @role('Receptionist')
                        @if (!empty(Auth::user()->image))
                            <img src="{{ asset('uploads/receptionist/' . Auth::user()->image) }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('admin-assets/dist/img/male.png') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @endif
                    @endrole
                    @role('Clinic Admin')
                        @if (!empty(Auth::user()->image))
                            <img src="{{ asset('uploads/admin/' . Auth::user()->image) }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('admin-assets/dist/img/male.png') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @endif
                    @endrole
                    @role('Doctor')
                        @if (!empty(Auth::user()->image))
                            <img src="{{ asset('uploads/doctor/' . Auth::user()->image) }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('admin-assets/dist/img/male.png') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @endif
                    @endrole
                    {{ Auth::user()->fname }}
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a href="{{ route('change.profile') }}" class="dropdown-item">Profile</a></li>
                    <li><a href="{{ route('change.password.index') }}" class="dropdown-item">Change Password</a></li>
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
