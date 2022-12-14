  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="brand-link">
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
                      <a href="{{ route('admin.dashboard') }}"
                          class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('appointments.index') }}"
                          class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-calendar"></i>
                          <p>
                              Appointments
                          </p>
                      </a>
                  </li>
                  @role('Super-Admin')
                      <li class="nav-item">
                          <a href="{{ route('clinics.index') }}"
                              class="nav-link {{ request()->routeIs('clinics.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-clinic-medical"></i>
                              <p>
                                  Clinics
                              </p>
                          </a>
                      </li>
                  @endrole
                  <li class="nav-item">
                      <a href="{{ route('patients.index') }}"
                          class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Patients
                          </p>
                      </a>
                  </li>
                  @hasanyrole('Super-Admin|Clinic Admin|Receptionist')
                      <li class="nav-item">
                          <a href="{{ route('doctors.index') }}"
                              class="nav-link {{ request()->routeIs('doctors.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                  Doctors
                              </p>
                          </a>
                      </li>
                  @endhasanyrole
                  @unlessrole('Receptionist|Doctor')
                      <li class="nav-item">
                          <a href="{{ route('receptionist.index') }}"
                              class="nav-link {{ request()->routeIs('receptionist.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-user-nurse"></i>
                              <p>
                                  Receptionist
                              </p>
                          </a>
                      </li>
                  @endunlessrole
                  @hasanyrole('Clinic Admin|Receptonist|Doctor')
                      <li class="nav-item">
                          <a href="{{ route('services.index') }}"
                              class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-clipboard-list"></i>
                              <p>
                                  Services
                              </p>
                          </a>
                      </li>
                  @endhasanyrole
                  @unlessrole('Receptionist|Super-Admin')
                      <li class="nav-item">
                          <a href="{{ route('schedules.index') }}"
                              class="nav-link {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-clock"></i>
                              <p>
                                  Doctor Schedule
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('prescription.index') }}"
                              class="nav-link {{ request()->routeIs('prescription.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-prescription"></i>
                              <p>
                                  Prescriptions
                              </p>
                          </a>
                      </li>
                  @endunlessrole
                  @unlessrole('Super-Admin')
                      <li class="nav-item">
                          <a href="{{ route('treated.index') }}"
                              class="nav-link {{ request()->routeIs('treated.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-user-check"></i>
                              <p>
                                  Treated
                              </p>
                          </a>
                      </li>
                  @endunlessrole
                  <li class="nav-item">
                      <a href="{{ route('reviews') }}"
                          class="nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-star"></i>
                          <p>
                              Reviews
                          </p>
                      </a>
                  </li>
                  @hasanyrole('Super-Admin|Clinic Admin')
                      <li
                          class="nav-item {{ request()->routeIs('medical.*') || request()->routeIs('report.*') || request()->routeIs('sales.*') ? 'menu-open' : '' }}">
                          <a href="#"
                              class="nav-link {{ request()->routeIs('medical.*') || request()->routeIs('report.*') || request()->routeIs('sales.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-file-pdf "></i>
                              <p>
                                  Reports
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('medical.show.report') }}"
                                      class="nav-link {{ request()->routeIs('medical.*') ? 'active' : '' }}">
                                      <i class="nav-icon fas fa-file-medical"></i>
                                      <p>Medical Report</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('report.services') }}"
                                      class="nav-link {{ request()->routeIs('report.*') ? 'active' : '' }}">
                                      <i class="nav-icon fas fa-file-alt"></i>
                                      <p>Services Report</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('sales.show.report') }}"
                                      class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">
                                      <i class="nav-icon fas fa-file-alt"></i>
                                      <p>Sales Report</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  @endhasanyrole
                  @hasrole('Super-Admin')
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
                                  <a href="{{ route('users.index') }}" class="nav-link">
                                      <i class="far fas fa-user"></i>
                                      <p>Users</p>
                                  </a>
                              </li>
                              {{-- <li class="nav-item">
                                  <a href="{{ route('roles.index') }}" class="nav-link">
                                      <i class="far fas fa-user"></i>
                                      <p>Roles</p>
                                  </a>
                              </li> --}}

                          </ul>
                      </li>
                  @endrole

                  @unlessrole('Doctor')
                      <li
                          class="nav-item {{ request()->routeIs('settings.*') || request()->routeIs('specialization.*') || request()->routeIs('paypal.*') ? 'menu-open' : '' }}">
                          <a href="#"
                              class="nav-link {{ request()->routeIs('settings.*') || request()->routeIs('specialization.*') || request()->routeIs('paypal.*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-wrench"></i>
                              <p>
                                  Settings
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              @hasrole('Super-Admin')
                                  <li class="nav-item">
                                      <a href="{{ route('settings.index') }}"
                                          class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                                          <i class="nav-icon fas fa-cog"></i>
                                          <p>System Settings</p>
                                      </a>
                                  </li>
                              @endrole
                              @hasanyrole('Super-Admin|Clinic Admin|Receptionist')
                                  <li class="nav-item">
                                      <a href="{{ route('specialization.index') }}"
                                          class="nav-link {{ request()->routeIs('specialization.*') ? 'active' : '' }}">
                                          <i class="nav-icon fas fa-tooth"></i>
                                          <p>Specialization</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('paypal.index') }}"
                                          class="nav-link {{ request()->routeIs('paypal.*') ? 'active' : '' }}">
                                          <i class="nav-icon fas fa-wallet"></i>
                                          <p>Payment</p>
                                      </a>
                                  </li>
                              @endhasrole
                          </ul>
                      </li>
                  @endunlessrole
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
