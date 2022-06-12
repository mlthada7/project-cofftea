<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
        <a class="navbar-brand" href="/">Cofftea</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ ($active === "home") ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active === "about") ? 'active' : '' }}" href="/about">About</a>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ ($active === "categories") ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="/categories/{{ $categories->slug }}">Coffee Beans</a></li>
                    <li><a class="dropdown-item" href="#">Tea</a></li>
                </ul>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link {{ ($active === "categories") ? 'active' : '' }}" href="#">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active === "cart") ? 'active' : '' }}" href="/cart">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
