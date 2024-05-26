<nav class="navbar navbar-expand navbar-bg">
    <a class="sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item nav-theme-toggle dropdown">
                <a class="nav-icon js-theme-toggle" href="#">
                    <div class="position-relative">
                        <i class="align-middle text-body nav-theme-toggle-light" data-lucide="sun"></i>
                        <i class="align-middle text-body nav-theme-toggle-dark" data-lucide="moon"></i>
                    </div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-lucide="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span>{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <p onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">Log
                            out</p>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
