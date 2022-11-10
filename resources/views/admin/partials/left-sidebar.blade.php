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
                      <a href="{{ route('admin.dashboard') }}"
                          class="nav-link {{ Route::current()->getName() == 'admin.dashboard' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('appointments.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'appointments.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-calendar"></i>
                          <p>
                              Appointments
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
                  <li class="nav-item">
                      <a href="{{ route('patients.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'patients.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Patients
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('doctors.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'doctors.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-md"></i>
                          <p>
                              Doctors
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('receptionist.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'receptionist.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-nurse"></i>
                          <p>
                              Receptionist
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('services.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'services.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Services
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('schedules.index') }}"
                          class="nav-link {{ Route::current()->getName() == 'schedules.index' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-clock"></i>
                          <p>
                              Doctor Schedule
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="" class="nav-link">
                          <i class="nav-icon fas fa-file-pdf "></i>
                          <p>
                              Reports
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              User Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fas fa-user"></i>
                                  <p>Users</p>
                              </a>
                          </li>

                      </ul>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
