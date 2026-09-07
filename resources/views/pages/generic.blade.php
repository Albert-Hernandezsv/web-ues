@extends('layouts.public')

@section('content')
    <section class="home-section">
        <div class="public-container">
            <div class="home-card">
                <div class="home-info-content">
                    <span class="home-section-badge">Página en construcción</span>
                    <h1 class="home-section-title">{{ $page->title }}</h1>
                    <p class="home-section-text">
                        Aquí luego mostraremos el contenido de la página <strong>{{ $page->name }}</strong>.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
