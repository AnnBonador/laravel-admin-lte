  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('admin-assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Admin Panel</span>
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
                          class="nav-link {{ Route::current()->getName() == 'user.dashboard' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('user.calendar.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'user.calendar.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-calendar"></i>
                          <p>
                              Calendar
                          </p>
                      </a>
                  <li class="nav-item">
                      <a href="{{ route('user.appointments.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'user.appointments.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-calendar"></i>
                          <p>
                              Appointments
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('patients.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'patients.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Payments
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('doctors.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'doctors.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-md"></i>
                          <p>
                              Prescription
                          </p>
                      </a>
                  <li class="nav-item">
                      <a href="{{ route('doctors.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'doctors.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-md"></i>
                          <p>
                              Reports
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('clinics.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'clinics.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-clinic-medical"></i>
                          <p>
                              Clinics
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
