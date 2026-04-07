@extends('layouts.public')

@section('content')
    <section class="page-section">
        <div class="public-container">
            <div class="news-detail">
                <div class="news-detail-header">
                    <span class="page-breadcrumb">
                        <a href="{{ route('home') }}">Inicio</a> /
                        <a href="{{ route('alumnis.index') }}">Alumnis</a> /
                        {{ $alumni->name }}
                    </span>

                    @if($alumni->published_at)
                        <p class="news-detail-date">
                            {{ $alumni->published_at->format('d/m/Y') }}
                        </p>
                    @endif

                    <h1 class="news-detail-title">{{ $alumni->name }}</h1>

                    @if($alumni->headline)
                        <p class="news-detail-summary">{{ $alumni->headline }}</p>
                    @endif

                    @if($alumni->company)
                        <p class="alumni-detail-company">{{ $alumni->company }}</p>
                    @endif
                </div>

                @if($alumni->image)
                    <div class="news-detail-image-wrap">
                        <img src="{{ asset('storage/' . $alumni->image) }}" alt="{{ $alumni->name }}" class="news-detail-image">
                    </div>
                @endif

                @if($alumni->summary)
                    <div class="alumni-detail-summary-box">
                        {{ $alumni->summary }}
                    </div>
                @endif

                <div class="news-detail-content">
                    {!! nl2br(e($alumni->content)) !!}
                </div>

                <div class="news-detail-actions">
                    <a href="{{ route('alumnis.index') }}" class="home-plan-button">
                        Volver a alumnis
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
