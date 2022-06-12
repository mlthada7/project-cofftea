<nav class="navbar navbar-expand-md navbar-dark fixed-top shadow-sm py-3" aria-label="Fourth navbar example" style="background-color: #1F2937">
    <div class="container">
        <a class="navbar-brand fs-4 me-5 fw-bold" href="/">Cofftea</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsNav" aria-controls="navbarsNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsNav">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About Us</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('cart') ? 'active' : '' }}" href="/cart"><i class="bi bi-cart-dash"></i> <span class="badge bg-info badge-pill cart-count w-30">{{ $cartCount }}</span></a>
                </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto me-0">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item {{ Request::is('profile') ? 'active' : '' }}" href="/profile"><i class="bi bi-person-circle"></i> Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ Request::is('my-orders') ? 'active' : '' }}" href="/my-orders"><i class="bi bi-layout-text-sidebar-reverse"></i> Order List</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <form action="/logout" method="post" class="pb-0 mb-0">
                                @csrf
                                <button type="submit" class="dropdown-item logout-link"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
            @else
            <li class="nav-item d-flex">
                <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }} btn btn-primary p-2 me-3 fw-normal text-light"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                <a href="/register" class="nav-link {{ Request::is('register') ? 'active' : '' }} btn btn-outline-primary p-2 fw-normal"><i class="bi bi-box-arrow-up-right"></i> Sign up</a>
            </li>
            @endauth
            </ul>

        </div>
    </div>
</nav>
