@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['perfil_hero'] ?? null;
        $intro = $sections['perfil_intro'] ?? null;
        $competencias = $sections['perfil_competencias'] ?? null;
        $expectativas = $sections['perfil_expectativas'] ?? null;
        $aspirante = $sections['perfil_aspirante'] ?? null;
        $egresado = $sections['perfil_egresado'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--perfil">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Egresados</span>
                    <h1 class="page-hero-title">Egresados</h1>

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

    @if($intro)
        <section class="page-section">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Formación profesional</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    @if($competencias && $competencias->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Competencias</span>
                    <h2 class="page-section-title">{{ $competencias->title }}</h2>
                    <p class="page-section-text">{{ $competencias->content }}</p>
                </div>

                <div class="perfil-grid">
                    @foreach($competencias->items as $item)
                        <article class="perfil-card">
                            <h3 class="perfil-card-title">{{ $item->title }}</h3>
                            <p class="perfil-card-text">{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($expectativas && $expectativas->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Mercado laboral</span>
                    <h2 class="page-section-title">{{ $expectativas->title }}</h2>
                    <p class="page-section-text">{{ $expectativas->content }}</p>
                </div>

                <div class="perfil-list-box">
                    @foreach($expectativas->items as $item)
                        <div class="perfil-list-item">
                            <strong>{{ $item->title }}</strong>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($aspirante && $aspirante->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Ingreso a la carrera</span>
                    <h2 class="page-section-title">{{ $aspirante->title }}</h2>
                    <p class="page-section-text">{{ $aspirante->content }}</p>
                </div>

                <div class="perfil-aspirante-grid">
                    @foreach($aspirante->items as $item)
                        <article class="perfil-aspirante-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($egresado)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="alert-card">
                    <h2 class="alert-card-title">{{ $egresado->title }}</h2>
                    <p class="alert-card-text">{!! nl2br(e($egresado->content)) !!}</p>

                    @if($egresado->button_text && $egresado->button_link)
                        <div style="margin-top: 1.25rem;">
                            <a href="{{ $egresado->button_link }}" class="home-plan-button">
                                {{ $egresado->button_text }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
@endsection
