@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['contacto_hero'] ?? null;
        $info = $sections['contacto_info'] ?? null;
        $social = $sections['contacto_social'] ?? null;
        $maps = $sections['contacto_maps'] ?? null;
        $cta = $sections['contacto_cta'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--contacto">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Contacto</span>
                    <h1 class="page-hero-title">{{ $hero->title }}</h1>

                    @if($hero->subtitle)
                        <p class="page-hero-subtitle">{{ $hero->subtitle }}</p>
                    @endif

                    <div class="page-hero-text">
                        {!! nl2br(e($hero->content)) !!}
                    </div>
                </div>

                <div class="page-hero-media">
                    @if($hero->image_1)
                        <img src="{{ asset('storage/' . $hero->image_1) }}" alt="{{ $hero->title }}">
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if($info)
        <section class="page-section">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Canales oficiales</span>
                    <h2 class="page-section-title">{{ $info->title }}</h2>
                    <p class="page-section-text">{{ $info->content }}</p>
                </div>

                <div class="contact-cards-grid">
                    @if($info->extra_1)
                        <article class="contact-card">
                            <h3>Teléfono</h3>
                            <p>{{ $info->extra_1 }}</p>
                            <a href="tel:{{ preg_replace('/\s+/', '', $info->extra_1) }}">Llamar</a>
                        </article>
                    @endif

                    @if($info->extra_2)
                        <article class="contact-card">
                            <h3>Correo electrónico</h3>
                            <p>{{ $info->extra_2 }}</p>
                            <a href="mailto:{{ $info->extra_2 }}">Escribir correo</a>
                        </article>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <section class="page-section pt-0">
        <div class="public-container">
            <div class="contact-double-grid">
                @if($social)
                    <div class="contact-panel">
                        <span class="home-section-badge">Redes sociales</span>
                        <h2 class="page-section-title">{{ $social->title }}</h2>
                        <p class="page-section-text">{{ $social->content }}</p>

                        @if($social->button_text && $social->button_link)
                            <a href="{{ $social->button_link }}" target="_blank" class="home-plan-button">
                                {{ $social->button_text }}
                            </a>
                        @endif
                    </div>
                @endif

                @if($maps)
                    <div class="contact-panel">
                        <span class="home-section-badge">Ubicación</span>
                        <h2 class="page-section-title">{{ $maps->title }}</h2>
                        <p class="page-section-text">{{ $maps->content }}</p>

                        @if($maps->button_text && $maps->button_link)
                            <a href="{{ $maps->button_link }}" target="_blank" class="home-plan-button">
                                {{ $maps->button_text }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if($maps && $maps->button_link)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="contact-map-embed">
                    <iframe
                        src="https://www.google.com/maps?q=Facultad%20Multidisciplinaria%20de%20Occidente%20UES&output=embed"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>
    @endif

    @if($cta)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="alert-card">
                    <h2 class="alert-card-title">{{ $cta->title }}</h2>
                    <p class="alert-card-text">{!! nl2br(e($cta->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif
@endsection
