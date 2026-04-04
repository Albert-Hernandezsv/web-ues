<footer class="public-footer">
    <div class="public-footer-top-line"></div>

    <div class="public-container public-footer-grid">
        <div>
            <img src="{{ asset('img/brand/logo-footer.png') }}"
                 alt="Ingeniería en Desarrollo de Software"
                 class="public-footer-logo">

            <p class="public-footer-text">
                Sitio informativo de la carrera Ingeniería en Desarrollo de Software,
                Facultad Multidisciplinaria de Occidente, Universidad de El Salvador.
            </p>
        </div>

        <div>
            <h3 class="public-footer-title">Navegación</h3>
            <ul class="public-footer-links">
                @foreach($menuPages as $menuPage)
                    <li>
                        <a href="{{ $menuPage->slug === 'inicio' ? route('home') : route('page.show', $menuPage->slug) }}">
                            {{ $menuPage->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="public-footer-title">Contacto institucional</h3>
            <p class="public-footer-text">
                Facultad Multidisciplinaria de Occidente<br>
                Universidad de El Salvador
            </p>
            <p class="public-footer-text">
                Santa Ana, El Salvador
            </p>
        </div>
    </div>

    <div class="public-footer-bottom">
        <div class="public-container public-footer-bottom-inner">
            <span>© {{ now()->year }} Ingeniería en Desarrollo de Software</span>
            <span>Universidad de El Salvador</span>
        </div>
    </div>
</footer>
