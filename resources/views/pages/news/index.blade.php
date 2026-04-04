@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['news_hero'] ?? null;
        $intro = $sections['news_intro'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--news">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Noticias</span>
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
                    <span class="home-section-badge">Publicaciones</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    <section class="page-section pt-0">
        <div class="public-container">
            @if($newsItems->count())
                <div class="news-grid-page">
                    @foreach($newsItems as $item)
                        <article class="news-page-card">
                            @if($item->image)
                                <a href="{{ route('news.show', $item->slug) }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                </a>
                            @else
                                <div class="home-empty-image"></div>
                            @endif

                            <div class="news-page-card-body">
                                @if($item->published_at)
                                    <span class="news-page-date">
                                        {{ $item->published_at->format('d/m/Y') }}
                                    </span>
                                @endif

                                <h3 class="news-page-card-title">
                                    <a href="{{ route('news.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h3>

                                <p class="news-page-card-summary">
                                    {{ \Illuminate\Support\Str::limit($item->summary, 160) }}
                                </p>

                                <a href="{{ route('news.show', $item->slug) }}" class="news-page-link">
                                    Leer noticia
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="news-pagination">
                    {{ $newsItems->links() }}
                </div>
            @else
                <div class="home-card">
                    <div class="home-info-content">
                        <span class="home-section-badge">Sin publicaciones</span>
                        <h2 class="page-section-title">Aún no hay noticias disponibles</h2>
                        <p class="page-section-text">
                            Cuando se publiquen nuevas noticias o avisos, aparecerán en esta sección.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
