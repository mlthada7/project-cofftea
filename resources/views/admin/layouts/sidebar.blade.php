<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 shadow-lg" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src="/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Admin Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav ">
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} p-1 my-2" href="https://dashboard.sandbox.midtrans.com/transactions" target="_blank">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><i class="bi bi-house-fill me-1"></i> Dashboard</span>
            </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }} p-1 my-2 ps-5" href="/dashboard/orders">
                    {{-- <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"> --}}
                    {{-- <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i> --}}
                    {{-- </div> --}}
                    <span class="nav-link-text ms-1"><i class="bi bi-receipt me-1"></i> Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/billing') ? 'active' : '' }} p-1 my-2" href="https://dashboard.sandbox.midtrans.com/transactions" target="_blank">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1"><i class="bi bi-credit-card-fill me-1"></i> Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/products*') ? 'active' : '' }} p-1 my-2" href="{{ url('/dashboard/products') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i> --}}
                    </div>
                    <span class="nav-link-text ms-1"><i class="bi bi-box me-1"></i> Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }} p-1 my-2" href="{{ url('/dashboard/categories') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="bi bi-grid"></i> --}}
                    </div>
                    <span class="nav-link-text ms-1"><i class="bi bi-grid-fill me-1"></i> Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/users') ? 'active' : '' }} p-1 my-2" href="/dashboard/users">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> --}}
                    </div>
                    <span class="nav-link-text ms-1"><i class="bi bi-person-fill me-1"></i> Users</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
