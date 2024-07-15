<nav class="navbar navbar-expand-md justify-content-between fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/"><img class="me-2"
                src="assets/logo-ith.bee906d9.png" alt="Logo ITH" />Digilib ITH</a><button class="navbar-toggler border-0"
            type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links" aria-controls="navbar-links"
            aria-label="Toggle navigation">
            <span class="bi-list fs-2"></span>
        </button>
        <div class="collapse navbar-collapse gap-3 justify-content-end" id="navbar-links">
            <div class="navbar-nav order-md-last flex-grow-0">
                
                <li class="nav-item">
                    <a class="nav-link" href="/prodi">Prodi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/faq">FAQ</a>
                </li>
                <li class="nav-item">
                    @guest
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login"
                            aria-current="page">Masuk</a>
                    @endguest
                    @auth
                        <a class="nav-link" href="/dashboard" aria-current="page">Hi, {{ auth()->user()->nama }}</a>
                    @endauth
                </li>
            </div>
        </div>
    </div>
</nav>
