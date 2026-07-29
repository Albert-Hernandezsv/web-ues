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
            @php
                $menuBySlug = $menuPages->keyBy('slug');

                $resolveMenuItem = function (string $slug) use ($menuBySlug) {
                    if ($slug === 'egresados') {
                        return [
                            'label' => 'Egresados',
                            'url' => route('egresados.index'),
                            'active' => request()->routeIs('egresados.index')
                                || request()->routeIs('egresados.parte*')
                                || request()->is('perfil_egresado')
                                || request()->is('pre-egresados'),
                        ];
                    }

                    $menuPage = $menuBySlug->get($slug);

                    if (!$menuPage) {
                        return null;
                    }

                    if ($slug === 'inicio') {
                        $pageUrl = route('home');
                        $isActive = request()->routeIs('home');
                    } elseif ($slug === 'noticias') {
                        $pageUrl = route('news.index');
                        $isActive = request()->routeIs('news.*');
                    } elseif ($slug === 'descargas') {
                        $pageUrl = route('downloads.index');
                        $isActive = request()->routeIs('downloads.index');
                    } elseif ($slug === 'alumnis') {
                        $pageUrl = route('alumnis.index');
                        $isActive = request()->routeIs('alumnis.index') || request()->routeIs('alumnis.show');
                    } elseif ($slug === 'galeria') {
                        $pageUrl = route('gallery.index');
                        $isActive = request()->routeIs('gallery.index');
                    } else {
                        $pageUrl = route('page.show', $slug);
                        $isActive = request()->is($slug) || request()->is('pagina/' . $slug);
                    }

                    return [
                        'label' => $menuPage->name,
                        'url' => $pageUrl,
                        'active' => $isActive,
                    ];
                };

                $homeItem = $resolveMenuItem('inicio');
                $menuGroups = [
                    'Carrera' => ['ingreso', 'plan_estudio', 'egresados'],
                    'Comunidad' => ['noticias', 'galeria', 'alumnis'],
                    'Recursos' => ['descargas', 'contacto'],
                ];
            @endphp

            @if($homeItem)
                <a href="{{ $homeItem['url'] }}" class="public-nav-link {{ $homeItem['active'] ? 'active' : '' }}">
                    {{ $homeItem['label'] }}
                </a>
            @endif

            @foreach($menuGroups as $groupLabel => $groupSlugs)
                @php
                    $groupItems = collect($groupSlugs)->map(fn ($slug) => $resolveMenuItem($slug))->filter();
                    $groupIsActive = $groupItems->contains('active', true);
                @endphp

                @if($groupItems->isNotEmpty())
                    <div class="public-nav-group {{ $groupIsActive ? 'active' : '' }}">
                        <button class="public-nav-link public-nav-trigger" type="button" aria-haspopup="true" aria-expanded="false">
                            {{ $groupLabel }}
                            <span class="public-nav-chevron" aria-hidden="true"></span>
                        </button>

                        <div class="public-subnav">
                            @foreach($groupItems as $item)
                                <a href="{{ $item['url'] }}" class="public-subnav-link {{ $item['active'] ? 'active' : '' }}">
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
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

        document.querySelectorAll('.public-nav-trigger').forEach((trigger) => {
            trigger.addEventListener('click', () => {
                const group = trigger.closest('.public-nav-group');
                const isOpen = group.classList.toggle('is-open');

                trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        });
    })();
</script>
