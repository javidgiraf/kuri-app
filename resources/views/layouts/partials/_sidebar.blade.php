<style>
  .js {
    color: #4154f1 !important;
  }
</style>

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ Route::is('home') ? '' : 'collapsed' }}" href=" {{route('home')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
    @can(['schemes.index'])
    <li class="nav-item">
      <a class="nav-link {{ Route::is('schemes.*') ? '' : 'collapsed' }}" href="{{route('schemes.index')}}">
        <i class="bi bi-menu-button-wide"></i>
        <span>Schemes</span>
      </a>
    </li>
    @endcan

    @can(['roles.index', 'permissions.index'])
    <li class="nav-item">
      <a class="nav-link {{ Route::is('roles.*') || Route::is('permissions.*') ? '' : 'collapsed' }}" data-bs-target="#roles-permissions-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>User Controls</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="roles-permissions-nav" class="nav-content collapse  {{ Route::is('roles.*') || Route::is('permissions.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">

        <li>
          <a class="{{ Route::is('roles.*')? 'js' : ''}}" href="{{route('roles.index')}}">
            <i class="bi bi-circle"></i><span>Assign Roles</span>
          </a>
        </li>
        <li>
          <a class="{{ Route::is('permissions.*')? 'js' : ''}}" href="{{route('permissions.index')}}">
            <i class="bi bi-circle"></i><span>Permissions</span>
          </a>
        </li>

      </ul>
    </li><!-- End Components Nav -->
    @endcan
    @can(['users.index'])
    <li class="nav-item">
      <a class="nav-link {{ Route::is('users.*') ? '' : 'collapsed' }}" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="users-nav" class="nav-content collapse {{ Route::is('users.*') ? 'show' : '' }} " data-bs-parent="#sidebar-nav">

        <li>
          <a class="{{ Route::is('users.index')||Route::is('users.edit')||Route::is('users.create')? 'js' : ''}}" href="{{route('users.index')}}">
            <i class="bi bi-circle"></i><span>Users</span>
          </a>
        </li>

        <li>
          <a class="{{ Route::is('subscriptions.index')|| Route::is('subscriptions.create')? 'js' : ''}}" href="{{route('subscriptions.index')}}">
            <i class="bi bi-circle"></i><span>Users Plans</span>
          </a>
        </li>
        <li>
          <a class="{{ Route::is('users.get-user-subscriptions')||Route::is('users.edit-scheme-details')? 'js' : ''}}" href="{{route('users.get-user-subscriptions')}}">
            <i class="bi bi-circle"></i><span>Users Subscriptions</span>
          </a>
        </li>


      </ul>
    </li><!-- End Components Nav -->
    @endcan
    @can(['orders.index'])
    <li class="nav-item">
      <a class="nav-link {{ Route::is('orders.*') ? '' : 'collapsed' }}" href="{{route('orders.index')}}">
        <i class="bi bi-menu-button-wide"></i>
        <span>Orders</span>
      </a>
    </li>
    @endcan
    @can(['deposits.index'])
    <li class="nav-item">
      <a class="nav-link {{ Route::is('deposits.*') ? '' : 'collapsed' }}" href="{{route('deposits.index')}}">
        <i class="bi bi-menu-button-wide"></i>
        <span>Deposits</span>
      </a>
    </li>
    @endcan

    @can(['transaction-details.index'])
    <li class="nav-item">
      <a class="nav-link {{ Route::is('transaction-details.*') ? '' : 'collapsed' }}" href="{{route('transaction-details.index')}}">
        <i class="bi bi-menu-button-wide"></i>
        <span>Transaction Details</span>
      </a>
    </li>
    @endcan



    @can(['goldrates.index', 'countries.index','settings.index'])
    <li class="nav-item">
      <a class="nav-link {{ Route::is('goldrates.*') || Route::is('logactivities.*') || Route::is('countries.*') || Route::is('states.*') || Route::is('districts.*') || Route::is('settings.*')  ? '' : 'collapsed' }}" data-bs-target="#gold-rate-nav" data-bs-toggle="collapse" href="#">
        <i class="ri ri-settings-3-line"></i><span>General Settings</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="gold-rate-nav" class="nav-content collapse {{ Route::is('goldrates.*') || Route::is('logactivities.*') || Route::is('countries.*') || Route::is('states.*') || Route::is('districts.*') || Route::is('settings.*')  ? 'show' : '' }} " data-bs-parent="#sidebar-nav">

        <li>
          <a class="{{ Route::is('goldrates.*')? 'js' : ''}}" href="{{route('goldrates.index')}}">
            <i class="bi bi-circle"></i><span>Gold Rate</span>
          </a>
        </li>

        <li>
          <a class="{{ Route::is('logactivities.*')? 'js' : ''}}" href="{{route('logactivities.index')}}">
            <i class="bi bi-circle"></i><span>User Activity Log</span>
          </a>
        </li>

        <li>
          <a class="{{ Route::is('countries.*')? 'js' : ''}}" href="{{route('countries.index')}}">
            <i class="bi bi-circle"></i><span>Countries</span>
          </a>
        </li>
        <li>
          <a class="{{ Route::is('states.*')? 'js' : ''}}" href="{{route('states.index')}}">
            <i class="bi bi-circle"></i><span>States</span>
          </a>
        </li>
        <li>
          <a class="{{ Route::is('districts.*')? 'js' : ''}}" href="{{route('districts.index')}}">
            <i class="bi bi-circle"></i><span>Districts</span>
          </a>
        </li>

        <li>
          <a class="{{ Route::is('settings.*')? 'js' : ''}}" href="{{route('settings.index')}}">
            <i class="bi bi-circle"></i><span>Settings</span>
          </a>
        </li>
        <li>
          <a class="{{ Route::is('scheme-settings.*')? 'js' : ''}}" href="{{route('scheme-settings.index')}}">
            <i class="bi bi-circle"></i><span>Scheme Settings</span>
          </a>
        </li>



      </ul>
    </li>

    @endcan

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav --> --}}

  </ul>

</aside><!-- End Sidebar-->
