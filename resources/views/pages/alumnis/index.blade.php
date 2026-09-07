@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['alumnis_hero'] ?? null;
        $intro = $sections['alumnis_intro'] ?? null;
    @endphp

    @if($hero)
        <section class="page-hero page-hero--alumnis">
            <div class="public-container page-hero-grid">
                <div>
                    <span class="page-breadcrumb">Inicio / Alumnis</span>
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
                    <span class="home-section-badge">Trayectorias</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    <section class="page-section pt-0">
        <div class="public-container">
            @if($alumnis->count())
                <div class="alumnis-grid">
                    @foreach($alumnis as $item)
                        <article class="alumni-card">
                            @if($item->image)
                                <a href="{{ route('alumnis.show', $item->slug) }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                </a>
                            @endif

                            <div class="alumni-card-body">
                                @if($item->published_at)
                                    <span class="news-page-date">{{ $item->published_at->format('d/m/Y') }}</span>
                                @endif

                                <h3 class="alumni-card-title">
                                    <a href="{{ route('alumnis.show', $item->slug) }}">
                                        {{ $item->name }}
                                    </a>
                                </h3>

                                @if($item->headline)
                                    <p class="alumni-card-headline">{{ $item->headline }}</p>
                                @endif

                                @if($item->company)
                                    <p class="alumni-card-company">{{ $item->company }}</p>
                                @endif

                                <p class="alumni-card-summary">
                                    {{ \Illuminate\Support\Str::limit($item->summary, 160) }}
                                </p>

                                <a href="{{ route('alumnis.show', $item->slug) }}" class="news-page-link">
                                    Leer historia
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="news-pagination">
                    {{ $alumnis->links() }}
                </div>
            @else
                <div class="home-card">
                    <div class="home-info-content">
                        <span class="home-section-badge">Sin publicaciones</span>
                        <h2 class="page-section-title">Aún no hay historias publicadas</h2>
                        <p class="page-section-text">
                            Cuando se publiquen casos de éxito, aparecerán en esta sección.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
