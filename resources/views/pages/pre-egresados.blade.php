@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['preegreso_hero'] ?? null;
        $intro = $sections['preegreso_intro'] ?? null;
        $especializaciones = $sections['preegreso_especializaciones'] ?? null;
        $trabajos = $sections['preegreso_trabajos_grado'] ?? null;
        $servicio = $sections['preegreso_servicio_social'] ?? null;
        $pasos = $sections['preegreso_servicio_pasos'] ?? null;
        $cta = $sections['preegreso_cta'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--preegreso">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Pre-egresados</span>
                    <h1 class="page-hero-title">{{ $hero->title }}</h1>
                    @if($hero->subtitle)
                        <p class="page-hero-subtitle">{{ $hero->subtitle }}</p>
                    @endif
                    <div class="page-hero-text">{!! nl2br(e($hero->content)) !!}</div>
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
                    <span class="home-section-badge">Etapa final</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    @if($especializaciones && $especializaciones->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Especialización</span>
                    <h2 class="page-section-title">{{ $especializaciones->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($especializaciones->content)) !!}</p>
                </div>

                <div class="preegreso-grid">
                    @foreach($especializaciones->items as $item)
                        <article class="preegreso-card">
                            @if($item->subtitle)
                                <span class="preegreso-card-badge">{{ $item->subtitle }}</span>
                            @endif
                            <h3 class="preegreso-card-title">{{ $item->title }}</h3>
                            <p class="preegreso-card-text">{!! nl2br(e($item->content)) !!}</p>
                            @if($item->extra_1)
                                <p class="preegreso-card-note">{{ $item->extra_1 }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($trabajos && $trabajos->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Trabajos de grado</span>
                    <h2 class="page-section-title">{{ $trabajos->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($trabajos->content)) !!}</p>
                </div>

                <div class="perfil-aspirante-grid">
                    @foreach($trabajos->items as $item)
                        <article class="perfil-aspirante-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($servicio)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="plan-summary-box">
                    <div>
                        <h2 class="page-section-title">{{ $servicio->title }}</h2>
                        <p class="page-section-text">{!! nl2br(e($servicio->content)) !!}</p>
                    </div>

                    <div class="plan-summary-stats">
                        @if($servicio->extra_1)
                            <div class="plan-stat-card"><strong>{{ $servicio->extra_1 }}</strong></div>
                        @endif
                        @if($servicio->extra_2)
                            <div class="plan-stat-card"><strong>{{ $servicio->extra_2 }}</strong></div>
                        @endif
                    </div>
                </div>

                @if($servicio->items->count())
                    <div class="perfil-list-box" style="margin-top: 1.5rem;">
                        @foreach($servicio->items as $item)
                            <div class="perfil-list-item">
                                <strong>{{ $item->subtitle ?: $item->title }}</strong>
                                <p>{!! nl2br(e($item->content)) !!}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if($pasos && $pasos->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Trámite</span>
                    <h2 class="page-section-title">{{ $pasos->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($pasos->content)) !!}</p>
                </div>

                <div class="steps-grid">
                    @foreach($pasos->items as $item)
                        <article class="step-card">
                            <div class="step-card-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="step-card-title">{{ $item->title }}</h3>
                            <p class="step-card-text">{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
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

                    @if($cta->button_text && $cta->button_link)
                        <div style="margin-top: 1.25rem;">
                            <a href="{{ $cta->button_link }}" class="home-plan-button">
                                {{ $cta->button_text }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
@endsection
