@extends('layouts.public')

@section('content')
    <section class="page-section">
        <div class="public-container">
            <div class="news-detail">
                <div class="news-detail-header">
                    <span class="page-breadcrumb">
                        <a href="{{ route('home') }}">Inicio</a> /
                        <a href="{{ route('news.index') }}">Noticias</a> /
                        {{ $news->title }}
                    </span>

                    @if($news->published_at)
                        <p class="news-detail-date">
                            {{ $news->published_at->format('d/m/Y') }}
                        </p>
                    @endif

                    <h1 class="news-detail-title">{{ $news->title }}</h1>

                    @if($news->summary)
                        <p class="news-detail-summary">{{ $news->summary }}</p>
                    @endif
                </div>

                @if($news->image)
                    <div class="news-detail-image-wrap">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="news-detail-image">
                    </div>
                @endif

                <div class="news-detail-content">
                    {!! nl2br(e($news->content)) !!}
                </div>

                <div class="news-detail-actions">
                    <a href="{{ route('news.index') }}" class="home-plan-button">
                        Volver a noticias
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
