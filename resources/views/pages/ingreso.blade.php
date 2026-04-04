@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['ingreso_hero'] ?? null;
        $periodo = $sections['ingreso_periodo'] ?? null;
        $steps = $sections['ingreso_steps'] ?? null;
        $recordatorio = $sections['ingreso_recordatorio'] ?? null;
        $contacto = $sections['ingreso_contacto'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--ingreso">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Admisiones / Ingreso UES</span>
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

    @if($periodo)
        <section class="page-section">
            <div class="public-container">
                <div class="info-banner">
                    <div>
                        <span class="home-section-badge">Período oficial</span>
                        <h2 class="page-section-title">{{ $periodo->title }}</h2>
                        <p class="page-section-text">{!! nl2br(e($periodo->content)) !!}</p>
                    </div>

                    @if($periodo->extra_1)
                        <div class="info-banner-date">
                            {{ $periodo->extra_1 }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if($steps)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Proceso de ingreso</span>
                    <h2 class="page-section-title">{{ $steps->title }}</h2>
                    <p class="page-section-text">{{ $steps->content }}</p>
                </div>

                <div class="steps-grid">
                    @foreach($steps->items as $item)
                        <article class="step-card">
                            <div class="step-card-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="step-card-title">{{ $item->title }}</h3>
                            <p class="step-card-text">{!! nl2br(e($item->content)) !!}</p>

                            @if($item->link)
                                <a href="{{ $item->link }}" target="_blank" class="step-card-link">
                                    Ir al enlace
                                </a>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($recordatorio)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="alert-card">
                    <h2 class="alert-card-title">{{ $recordatorio->title }}</h2>
                    <p class="alert-card-text">{!! nl2br(e($recordatorio->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    @if($contacto)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="contact-box">
                    <div>
                        <span class="home-section-badge">Más información</span>
                        <h2 class="page-section-title">{{ $contacto->title }}</h2>
                        <p class="page-section-text">{!! nl2br(e($contacto->content)) !!}</p>

                        @if($contacto->extra_1)
                            <p class="contact-email">
                                {{ $contacto->extra_1 }}
                            </p>
                        @endif
                    </div>

                    @if($contacto->button_text && $contacto->button_link)
                        <div>
                            <a href="{{ $contacto->button_link }}" target="_blank" class="home-plan-button">
                                {{ $contacto->button_text }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
@endsection
