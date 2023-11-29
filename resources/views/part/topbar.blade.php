<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      @auth
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <button class="btn btn-sm btn-outline-primary rounded-pill fw-bold me-2 me-xl-0">
            0.00000000
          </button>
        </a>
      </li>
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <i class="bx bx-user"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="/logout">
              <i class="bx bx-log-out me-2"></i>
              <span class="align-middle">Logout</span>
            </a>
          </li>
        </ul>
      </li>
      @endauth
      @guest
      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-connect">Connect</button>
      @endguest
    </ul>
  </div>
</nav>