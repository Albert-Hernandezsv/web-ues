@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['downloads_hero'] ?? null;
        $intro = $sections['downloads_intro'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--downloads">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Descargas</span>
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
                    <span class="home-section-badge">Archivos disponibles</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    <section class="page-section pt-0">
        <div class="public-container">
            @if($downloads->count())
                <div class="downloads-grid">
                    @foreach($downloads as $item)
                        <article class="download-card">
                            <div class="download-card-top">
                                <span class="download-badge">
                                    {{ strtoupper($item->file_type ?? 'ARCHIVO') }}
                                </span>
                            </div>

                            <h3 class="download-card-title">{{ $item->title }}</h3>

                            @if($item->description)
                                <p class="download-card-text">
                                    {{ $item->description }}
                                </p>
                            @endif

                            <a href="{{ route('downloads.file', $item) }}" class="download-card-button">
                                Descargar
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="home-card">
                    <div class="home-info-content">
                        <span class="home-section-badge">Sin archivos</span>
                        <h2 class="page-section-title">Aún no hay documentos disponibles</h2>
                        <p class="page-section-text">
                            Cuando se publiquen archivos descargables, aparecerán en esta sección.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
