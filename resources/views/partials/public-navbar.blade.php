<header class="public-navbar">
    <div class="public-container public-navbar-inner">
        <a href="{{ route('home') }}" class="public-brand">
            <img src="{{ asset('img/brand/logo-navbar.png') }}"
                 alt="Ingeniería en Desarrollo de Software"
                 class="public-brand-logo">
        </a>

        <button class="public-menu-toggle" type="button" id="menuToggle" aria-label="Abrir menú">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="public-nav" id="publicNav">
            @foreach($menuPages as $menuPage)
                @php
                    if ($menuPage->slug === 'inicio') {
                        $pageUrl = route('home');
                        $isActive = request()->routeIs('home');
                    } elseif ($menuPage->slug === 'noticias') {
                        $pageUrl = route('news.index');
                        $isActive = request()->routeIs('news.*'); // Simplificado para capturar index y show
                    } elseif ($menuPage->slug === 'descargas') {
                        $pageUrl = route('downloads.index');
                        $isActive = request()->routeIs('downloads.index');
                    } elseif ($menuPage->slug === 'alumnis') {
                        $pageUrl = route('alumnis.index');
                        $isActive = request()->routeIs('alumnis.index') || request()->routeIs('alumnis.show');
                    } elseif ($menuPage->slug === 'galeria') {
                        $pageUrl = route('gallery.index');
                        $isActive = request()->routeIs('gallery.index');
                    } else {
                        // Este es el caso por defecto para cualquier otro slug
                        $pageUrl = route('page.show', $menuPage->slug);
                        $isActive = request()->is($menuPage->slug) || request()->is('pagina/' . $menuPage->slug);
                    }
                @endphp

                <a href="{{ $pageUrl }}"
                class="public-nav-link {{ $isActive ? 'active' : '' }}">
                    {{ $menuPage->name }}
                </a>
            @endforeach
        </nav>
    </div>
</header>

<script>
    (() => {
        const toggle = document.getElementById('menuToggle');
        const nav = document.getElementById('publicNav');

        if (toggle && nav) {
            toggle.addEventListener('click', () => {
                nav.classList.toggle('is-open');
                toggle.classList.toggle('is-open');
            });
        }
    })();
</script>
