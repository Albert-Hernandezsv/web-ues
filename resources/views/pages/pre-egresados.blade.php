@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['preegreso_hero'] ?? null;
        $intro = $sections['preegreso_intro'] ?? null;
        $espIntro = $sections['preegreso_especializaciones_intro'] ?? null;
        $espMaterias = $sections['preegreso_especializaciones_materias'] ?? null;
        $trabajos = $sections['preegreso_trabajos_grado'] ?? null;
        $ssIntro = $sections['preegreso_servicio_social_intro'] ?? null;
        $ssReq = $sections['preegreso_servicio_social_requisitos'] ?? null;
        $ssObj = $sections['preegreso_servicio_social_objetivos'] ?? null;
        $ssMod = $sections['preegreso_servicio_social_modalidades'] ?? null;
        $ssPas = $sections['preegreso_servicio_social_pasos'] ?? null;
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

    @if($espIntro)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Especializaciones</span>
                    <h2 class="page-section-title">{{ $espIntro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($espIntro->content)) !!}</p>
                </div>

                @if($espIntro->items->count())
                    <div class="preegreso-grid">
                        @foreach($espIntro->items as $item)
                            <article class="preegreso-card">
                                @if($item->subtitle)
                                    <span class="preegreso-card-badge">{{ $item->subtitle }}</span>
                                @endif
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="preegreso-card-image">
                                @endif
                                <h3 class="preegreso-card-title">{{ $item->title }}</h3>
                                <p class="preegreso-card-text">{!! nl2br(e($item->content)) !!}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if($espMaterias && $espMaterias->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Pensum por línea</span>
                    <h2 class="page-section-title">{{ $espMaterias->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($espMaterias->content)) !!}</p>
                </div>

                <div class="preegreso-grid">
                    @foreach($espMaterias->items as $item)
                        <article class="preegreso-card">
                            <h3 class="preegreso-card-title">{{ $item->title }}</h3>
                            @if($item->subtitle)
                                <p class="preegreso-card-note">{{ $item->subtitle }}</p>
                            @endif
                            <div class="plan-cycle-content" style="padding:0; margin-top: 1rem;">
                                {!! nl2br(e($item->content)) !!}
                            </div>
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

                <div class="downloads-grid">
                    @foreach($trabajos->items as $item)
                        <article class="download-card">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="download-card-image">
                            @endif
                            <h3 class="download-card-title">{{ $item->title }}</h3>
                            <p class="download-card-text">{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssIntro)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="plan-summary-box">
                    <div>
                        <h2 class="page-section-title">{{ $ssIntro->title }}</h2>
                        <p class="page-section-text">{!! nl2br(e($ssIntro->content)) !!}</p>
                    </div>
                    <div class="plan-summary-stats">
                        @if($ssIntro->extra_1)
                            <div class="plan-stat-card"><strong>{{ $ssIntro->extra_1 }}</strong></div>
                        @endif
                        @if($ssIntro->extra_2)
                            <div class="plan-stat-card"><strong>{{ $ssIntro->extra_2 }}</strong></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($ssReq && $ssReq->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Servicio social</span>
                    <h2 class="page-section-title">{{ $ssReq->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssReq->content)) !!}</p>
                </div>
                <div class="perfil-list-box">
                    @foreach($ssReq->items as $item)
                        <div class="perfil-list-item">
                            <strong>{{ $item->subtitle ?: $item->title }}</strong>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssObj && $ssObj->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Objetivos</span>
                    <h2 class="page-section-title">{{ $ssObj->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssObj->content)) !!}</p>
                </div>
                <div class="perfil-aspirante-grid">
                    @foreach($ssObj->items as $item)
                        <article class="perfil-aspirante-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssMod && $ssMod->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Modalidades</span>
                    <h2 class="page-section-title">{{ $ssMod->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssMod->content)) !!}</p>
                </div>
                <div class="perfil-aspirante-grid">
                    @foreach($ssMod->items as $item)
                        <article class="perfil-aspirante-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssPas && $ssPas->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Trámite</span>
                    <h2 class="page-section-title">{{ $ssPas->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssPas->content)) !!}</p>
                </div>
                <div class="steps-grid">
                    @foreach($ssPas->items as $item)
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
