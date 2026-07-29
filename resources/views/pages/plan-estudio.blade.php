@extends('layouts.public')

@section('content')
    @php
        $hero = $sections['plan_hero'] ?? null;
        $intro = $sections['plan_intro'] ?? null;
        $summary = $sections['plan_summary'] ?? null;
        $specializations = $sections['plan_especializaciones_intro'] ?? null;
        $specializationSubjects = $sections['plan_especializaciones_materias'] ?? null;
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

    <section class="page-section pt-0">
        <div class="public-container">
            <div class="plan-study-mode">
                <div class="section-heading">
                    <span class="home-section-badge">Modalidad de estudio</span>
                    <h2 class="page-section-title">Metodología y modalidad de enseñanza-aprendizaje</h2>
                    <p class="page-section-text">
                        Cada asignatura combina trabajo asincrónico y sesiones sincrónicas para acompañar el aprendizaje
                        del estudiante durante todo el ciclo académico.
                    </p>
                </div>

                <div class="plan-study-mode-grid">
                    <article class="plan-study-mode-card">
                        <h3>Estudio asincrónico</h3>
                        <p>
                            El estudiante revisa y desarrolla el material didáctico provisto por el tutor, avanzando de
                            forma autónoma según las orientaciones de cada materia.
                        </p>
                    </article>

                    <article class="plan-study-mode-card">
                        <h3>Sesiones sincrónicas</h3>
                        <p>
                            Se realizan sesiones en línea de 100 minutos, donde se abordan los temas de la asignatura y
                            se aclaran dudas con el tutor.
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    @if($specializations)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Especializaciones</span>
                    <h2 class="page-section-title">{{ $specializations->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($specializations->content)) !!}</p>
                </div>

                @if($specializations->items->count())
                    <div class="preegreso-grid">
                        @foreach($specializations->items as $item)
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

    @if($specializationSubjects && $specializationSubjects->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Pensum por línea</span>
                    <h2 class="page-section-title">{{ $specializationSubjects->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($specializationSubjects->content)) !!}</p>
                </div>

                <div class="plan-specializations-grid">
                    @foreach($specializationSubjects->items as $item)
                        @php
                            $lines = collect(preg_split('/\R+/', trim($item->content ?? '')))
                                ->map(fn ($line) => trim($line))
                                ->filter()
                                ->values();
                            $cycleGroups = [];
                            $currentCycle = null;

                            foreach ($lines as $line) {
                                if (strtolower($line) === 'materias por ciclo') {
                                    continue;
                                }

                                if (preg_match('/^Ciclo\s+(.+):$/i', $line, $matches)) {
                                    if ($currentCycle) {
                                        $cycleGroups[] = $currentCycle;
                                    }

                                    $currentCycle = [
                                        'name' => 'Ciclo ' . $matches[1],
                                        'subjects' => [],
                                    ];

                                    continue;
                                }

                                if (! $currentCycle) {
                                    $currentCycle = [
                                        'name' => 'Materias',
                                        'subjects' => [],
                                    ];
                                }

                                if (preg_match('/^(\d+)\s*-\s*(.+)$/', $line, $matches)) {
                                    $currentCycle['subjects'][] = [
                                        'number' => $matches[1],
                                        'title' => $matches[2],
                                        'prerequisite' => null,
                                        'note' => null,
                                    ];

                                    continue;
                                }

                                if (preg_match('/^Prerrequisitos?:\s*(.+)$/i', $line, $matches) && count($currentCycle['subjects'])) {
                                    $lastIndex = count($currentCycle['subjects']) - 1;
                                    $currentCycle['subjects'][$lastIndex]['prerequisite'] = $matches[1];

                                    continue;
                                }

                                $currentCycle['subjects'][] = [
                                    'number' => null,
                                    'title' => $line,
                                    'prerequisite' => null,
                                    'note' => true,
                                ];
                            }

                            if ($currentCycle) {
                                $cycleGroups[] = $currentCycle;
                            }
                        @endphp

                        <article class="plan-specialization-card">
                            <div class="plan-specialization-header">
                                <h3>{{ $item->title }}</h3>
                            </div>

                            @if($item->subtitle)
                                <p class="plan-specialization-note">{{ $item->subtitle }}</p>
                            @endif

                            <div class="plan-specialization-cycles">
                                @foreach($cycleGroups as $cycle)
                                    <section class="plan-specialization-cycle">
                                        <div class="plan-specialization-cycle-title">
                                            {{ $cycle['name'] }}
                                        </div>

                                        <div class="plan-subject-list">
                                            @foreach($cycle['subjects'] as $subject)
                                                <div class="plan-subject-item {{ $subject['note'] ? 'plan-subject-item--note' : '' }}">
                                                    @if($subject['number'])
                                                        <span class="plan-subject-number">{{ $subject['number'] }}</span>
                                                    @endif

                                                    <div class="plan-subject-body">
                                                        <h4>{{ $subject['title'] }}</h4>

                                                        @if($subject['prerequisite'])
                                                            <p>
                                                                <span>Prerrequisito</span>
                                                                {{ $subject['prerequisite'] }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
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
