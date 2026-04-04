@extends('layouts.public')

@section('content')
    @php
        $homeInfo = $sections['home_info'] ?? null;
        $homePlan = $sections['home_plan'] ?? null;
        $homeNews = $sections['home_news'] ?? null;
    @endphp

    <section class="home-slider" id="homeSlider">
        @foreach($sliderItems as $index => $item)
            <div class="home-slide {{ $index === 0 ? 'active' : '' }}">
                @if($item->link)
                    <a href="{{ $item->link }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    </a>
                @else
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                @endif

                <div class="home-slide-overlay"></div>

                <div class="home-slide-content">
                    <div class="home-slide-content-inner">
                        @if($item->title)
                            <h1 class="home-slide-title">{{ $item->title }}</h1>
                        @endif

                        @if($item->subtitle)
                            <p class="home-slide-subtitle">{{ $item->subtitle }}</p>
                        @endif

                        @if($item->link)
                            <a href="{{ $item->link }}" class="home-slide-button">
                                Conocer más
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        @if($sliderItems->count() > 1)
            <div class="home-slider-dots">
                @foreach($sliderItems as $index => $item)
                    <button class="home-slider-dot {{ $index === 0 ? 'active' : '' }}" type="button"></button>
                @endforeach
            </div>
        @endif
    </section>

    @if($homeInfo)
        <section class="home-section">
            <div class="public-container">
                <div class="home-info-grid">

                    <!-- CONTENIDO PRINCIPAL -->
                    <div class="home-card">
                        <div class="home-info-content">
                            <span class="home-section-badge">Ingeniería en Desarrollo de Software</span>
                            <h2 class="home-section-title">{{ $homeInfo->title }}</h2>
                            <div class="home-section-text">
                                {!! nl2br(e($homeInfo->content)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- SIDEBAR DERECHA -->
                    <div class="home-right-sidebar">

                        <!-- IMÁGENES -->
                        <div class="home-side-images">
                            <a href="{{ $homeInfo->image_1_link ?? '#' }}" class="home-side-image-link">
                                @if($homeInfo->image_1)
                                    <img src="{{ asset('storage/' . $homeInfo->image_1) }}" alt="Ingreso">
                                @else
                                    <div class="home-empty-image"></div>
                                @endif
                                <div class="home-side-image-overlay">
                                    <span class="home-side-image-label">Ingreso</span>
                                </div>
                            </a>

                            <a href="{{ $homeInfo->image_2_link ?? '#' }}" class="home-side-image-link">
                                @if($homeInfo->image_2)
                                    <img src="{{ asset('storage/' . $homeInfo->image_2) }}" alt="Perfil de egresado">
                                @else
                                    <div class="home-empty-image"></div>
                                @endif
                                <div class="home-side-image-overlay">
                                    <span class="home-side-image-label">Perfil de egresado</span>
                                </div>
                            </a>
                        </div>

                        <!-- NOTICIAS -->
                        @if($homeNews)
                            <div class="home-news-sidebar">

                                <div class="home-news-header">
                                    <h3 class="home-news-title">{{ $homeNews->title }}</h3>
                                </div>

                                <div class="home-news-list">
                                    @foreach($news->take(3) as $item)
                                        <article class="home-news-item">
                                            <h4>{{ $item->title }}</h4>
                                            <p>{{ \Illuminate\Support\Str::limit($item->summary, 80) }}</p>
                                            <a href="{{ route('news.show', $item->slug) }}">Ver más</a>
                                        </article>
                                    @endforeach
                                </div>

                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </section>
    @endif

    @if($homePlan)
        <section class="home-section pt-0">
            <div class="public-container">
                <div class="home-plan">
                    <div class="home-plan-grid">
                        <div>
                            <span class="home-section-badge home-section-badge--light">
                                Formación académica
                            </span>

                            <h2 class="home-plan-title">{{ $homePlan->title }}</h2>

                            <p class="home-plan-text">
                                {!! nl2br(e($homePlan->content)) !!}
                            </p>

                            @if($homePlan->button_text && $homePlan->button_link)
                                <a href="{{ $homePlan->button_link }}" class="home-plan-button">
                                    {{ $homePlan->button_text }}
                                </a>
                            @endif
                        </div>

                        <div>
                            <ul class="home-plan-list">
                                @if($homePlan->extra_1)<li>{{ $homePlan->extra_1 }}</li>@endif
                                @if($homePlan->extra_2)<li>{{ $homePlan->extra_2 }}</li>@endif
                                @if($homePlan->extra_3)<li>{{ $homePlan->extra_3 }}</li>@endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <script>
        (() => {
            const slides = document.querySelectorAll('.home-slide');
            const dots = document.querySelectorAll('.home-slider-dot');
            let currentSlide = 0;
            let sliderInterval = null;

            function showSlide(index) {
                slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
                dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
                currentSlide = index;
            }

            function nextSlide() {
                showSlide((currentSlide + 1) % slides.length);
            }

            if (slides.length > 1) {
                sliderInterval = setInterval(nextSlide, 5000);

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        showSlide(index);
                        clearInterval(sliderInterval);
                        sliderInterval = setInterval(nextSlide, 5000);
                    });
                });
            }

            const newsTrack = document.getElementById('newsTrack');
            const newsPrev = document.getElementById('newsPrev');
            const newsNext = document.getElementById('newsNext');

            if (newsTrack && newsPrev && newsNext) {
                let currentNews = 0;

                function getVisibleCards() {
                    if (window.innerWidth <= 768) return 1;
                    if (window.innerWidth <= 1024) return 2;
                    return 3;
                }

                function moveNewsCarousel() {
                    const cards = newsTrack.querySelectorAll('.home-news-card');
                    if (!cards.length) return;

                    const gap = 20;
                    const cardWidth = cards[0].offsetWidth + gap;
                    newsTrack.style.transform = `translateX(-${currentNews * cardWidth}px)`;
                }

                function maxIndex() {
                    const cards = newsTrack.querySelectorAll('.home-news-card');
                    return Math.max(0, cards.length - getVisibleCards());
                }

                newsNext.addEventListener('click', () => {
                    currentNews = currentNews >= maxIndex() ? 0 : currentNews + 1;
                    moveNewsCarousel();
                });

                newsPrev.addEventListener('click', () => {
                    currentNews = currentNews <= 0 ? maxIndex() : currentNews - 1;
                    moveNewsCarousel();
                });

                setInterval(() => {
                    currentNews = currentNews >= maxIndex() ? 0 : currentNews + 1;
                    moveNewsCarousel();
                }, 4500);

                window.addEventListener('resize', moveNewsCarousel);
                moveNewsCarousel();
            }
        })();
    </script>
@endsection
