  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
          <img src="{{ asset('uploads/setting/' . getLogo()) }}" alt="logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">{{ title() }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-4">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

                  <li class="nav-item">
                      <a href="{{ route('user.dashboard') }}"
                          class="nav-link {{ request()->routeIs('user.dashboard') || request()->routeIs('user.dashboard.show') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('user.appointments.index') }}"
                          class="nav-link {{ request()->routeIs('user.appointments.*') || request()->routeIs('user.ratings') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-calendar"></i>
                          <p>
                              Appointments
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('user.prescription.index') }}"
                          class="nav-link {{ request()->routeIs('user.prescription.index') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-prescription"></i>
                          <p>
                              Prescriptions
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('user.treated.index') }}"
                          class="nav-link {{ request()->routeIs('user.treated.index') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-check"></i>
                          <p>
                              Treated
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
