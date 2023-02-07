<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link {{ Request::is('monitor') ? 'active' : '' }}" href="/monitor">
              <span data-feather="monitor"></span>
              Monitor
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('servicedone*') ? 'active' : '' }}" href="/servicedone">
              <span data-feather="tool"></span>
              Service Done
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('servicepending*') ? 'active' : '' }}" href="/servicepending">
              <span data-feather="loader"></span>
              Service Pending
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('kanibal*') ? 'active' : '' }}" href="/kanibal">
              <span data-feather="cpu"></span>
              Kanibal
            </a>
          </li>
        </ul>
      </div>
    </nav>
