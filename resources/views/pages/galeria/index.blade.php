@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['gallery_hero'] ?? null;
        $intro = $sections['gallery_intro'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--gallery">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Galería</span>
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
                    <span class="home-section-badge">Multimedia</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    <section class="page-section pt-0">
        <div class="public-container">
            @if($galleries->count())
                <div class="gallery-grid">
                    @foreach($galleries as $item)
                        <article class="gallery-card">
                            <div class="gallery-media">
                                @if($item->media_type === 'image' && $item->file_path)
                                    <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}">
                                @elseif($item->media_type === 'video')
                                    @if($item->file_path)
                                        <video controls preload="metadata">
                                            <source src="{{ asset('storage/' . $item->file_path) }}">
                                            Tu navegador no soporta video.
                                        </video>
                                    @elseif($item->external_url)
                                        <iframe
                                            src="{{ $item->external_url }}"
                                            title="{{ $item->title }}"
                                            allowfullscreen>
                                        </iframe>
                                    @endif
                                @endif
                            </div>

                            <div class="gallery-card-body">
                                <span class="gallery-badge">
                                    {{ $item->media_type === 'image' ? 'Imagen' : 'Video' }}
                                </span>

                                <h3 class="gallery-card-title">{{ $item->title }}</h3>

                                @if($item->subtitle)
                                    <p class="gallery-card-subtitle">{{ $item->subtitle }}</p>
                                @endif

                                <div class="gallery-meta">
                                    @if($item->location)
                                        <span>{{ $item->location }}</span>
                                    @endif

                                    @if($item->event_date)
                                        <span>{{ $item->event_date->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="news-pagination">
                    {{ $galleries->links() }}
                </div>
            @else
                <div class="home-card">
                    <div class="home-info-content">
                        <span class="home-section-badge">Sin contenido</span>
                        <h2 class="page-section-title">Aún no hay elementos en la galería</h2>
                        <p class="page-section-text">
                            Cuando se publiquen imágenes o videos, aparecerán en esta sección.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
