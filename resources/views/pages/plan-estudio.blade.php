@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['plan_hero'] ?? null;
        $intro = $sections['plan_intro'] ?? null;
        $summary = $sections['plan_summary'] ?? null;
        $areas = $sections['plan_areas'] ?? null;
        $cycles = $sections['plan_cycles'] ?? null;
        $cta = $sections['plan_cta'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--plan">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Plan de estudios</span>
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

    @if($intro)
        <section class="page-section">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Estructura académica</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    @if($summary)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="plan-summary-box">
                    <div>
                        <h2 class="page-section-title">{{ $summary->title }}</h2>
                        <p class="page-section-text">{!! nl2br(e($summary->content)) !!}</p>
                    </div>

                    <div class="plan-summary-stats">
                        @if($summary->extra_1)
                            <div class="plan-stat-card">
                                <strong>{{ $summary->extra_1 }}</strong>
                            </div>
                        @endif

                        @if($summary->extra_2)
                            <div class="plan-stat-card">
                                <strong>{{ $summary->extra_2 }}</strong>
                            </div>
                        @endif

                        @if($summary->subtitle)
                            <div class="plan-stat-card">
                                <strong>{{ $summary->subtitle }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($areas && $areas->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Formación integral</span>
                    <h2 class="page-section-title">{{ $areas->title }}</h2>
                    <p class="page-section-text">{{ $areas->content }}</p>
                </div>

                <div class="plan-areas-grid">
                    @foreach($areas->items as $item)
                        <article class="plan-area-card">
                            <h3 class="plan-area-title">{{ $item->title }}</h3>
                            <p class="plan-area-text">{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($cycles && $cycles->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Pensum</span>
                    <h2 class="page-section-title">{{ $cycles->title }}</h2>
                    <p class="page-section-text">{{ $cycles->content }}</p>
                </div>

                <div class="plan-cycles-grid">
                    @foreach($cycles->items as $item)
                        <article class="plan-cycle-card">
                            <div class="plan-cycle-header">
                                <h3>{{ $item->title }}</h3>
                            </div>

                            <div class="plan-cycle-content">
                                {!! nl2br(e($item->content)) !!}
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($cta)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="contact-box">
                    <div>
                        <span class="home-section-badge">Continúa explorando</span>
                        <h2 class="page-section-title">{{ $cta->title }}</h2>
                        <p class="page-section-text">{!! nl2br(e($cta->content)) !!}</p>
                    </div>

                    @if($cta->button_text && $cta->button_link)
                        <div>
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
