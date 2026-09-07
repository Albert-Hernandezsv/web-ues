@extends('layouts.public')

@section('content')
    @php
        $hero = $perfilSections['perfil_hero'] ?? null;
        $intro = $perfilSections['perfil_intro'] ?? null;
        $competencias = $perfilSections['perfil_competencias'] ?? null;
        $expectativas = $perfilSections['perfil_expectativas'] ?? null;
        $aspirante = $perfilSections['perfil_aspirante'] ?? null;
        $egresado = $perfilSections['perfil_egresado'] ?? null;

        $preegresoIntro = $preegresoSections['preegreso_intro'] ?? null;
        $trabajos = $preegresoSections['preegreso_trabajos_grado'] ?? null;
        $ssIntro = $preegresoSections['preegreso_servicio_social_intro'] ?? null;
        $ssReq = $preegresoSections['preegreso_servicio_social_requisitos'] ?? null;
        $ssObj = $preegresoSections['preegreso_servicio_social_objetivos'] ?? null;
        $ssMod = $preegresoSections['preegreso_servicio_social_modalidades'] ?? null;
        $ssPas = $preegresoSections['preegreso_servicio_social_pasos'] ?? null;
        $cta = $preegresoSections['preegreso_cta'] ?? null;
    @endphp

    <section class="page-hero page-hero--perfil">
        <div class="public-container page-hero-grid">
            <div>
                <span class="page-breadcrumb">Inicio / Egresados</span>
                <h1 class="page-hero-title">Egresados</h1>

                @if($hero?->subtitle)
                    <p class="page-hero-subtitle">{{ $hero->subtitle }}</p>
                @endif

                @if($hero?->content)
                    <div class="page-hero-text">
                        {!! nl2br(e($hero->content)) !!}
                    </div>
                @endif
            </div>

            <div class="page-hero-media">
                @if($hero?->image_1)
                    <img src="{{ asset('storage/' . $hero->image_1) }}" alt="Egresados">
                @endif
            </div>
        </div>
    </section>

    @if($intro)
        <section class="page-section">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Formacion profesional</span>
                    <h2 class="page-section-title">{{ $intro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($intro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    @if($competencias && $competencias->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Competencias</span>
                    <h2 class="page-section-title">{{ $competencias->title }}</h2>
                    <p class="page-section-text">{{ $competencias->content }}</p>
                </div>

                <div class="perfil-grid">
                    @foreach($competencias->items as $item)
                        <article class="perfil-card">
                            <h3 class="perfil-card-title">{{ $item->title }}</h3>
                            <p class="perfil-card-text">{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($expectativas && $expectativas->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                @php
                    $laborItems = $expectativas->items
                        ->reject(fn ($item) => str_starts_with(strtolower(trim($item->title)), 'ciclo'))
                        ->values();
                    $cycleItems = $expectativas->items
                        ->filter(fn ($item) => str_starts_with(strtolower(trim($item->title)), 'ciclo'))
                        ->values();
                    $cycleItemsByLine = $cycleItems
                        ->filter(fn ($item) => filled($item->subtitle))
                        ->keyBy(fn ($item) => strtolower(trim($item->subtitle)));
                    $specializationItems = $laborItems;
                @endphp

                <div class="section-heading">
                    <span class="home-section-badge">Mercado laboral</span>
                    <h2 class="page-section-title">{{ $expectativas->title }}</h2>
                    <p class="page-section-text">{{ $expectativas->content }}</p>
                </div>

                <div class="egresados-specialization-grid">
                    @foreach($specializationItems as $item)
                        @php
                            $cycleItem = $cycleItemsByLine->get(strtolower(trim($item->title))) ?? $cycleItems->get($loop->index);
                            $cycleBlocks = $cycleItem
                                ? collect(preg_split('/(?=Ciclo\s+[IVXLCDM]+:)/i', trim($cycleItem->content ?? '')))
                                    ->map(fn ($block) => trim($block))
                                    ->filter()
                                    ->values()
                                : collect();
                        @endphp

                        <article class="egresados-specialization-card">
                            <div class="egresados-specialization-top">
                                <h3>{{ $item->title }}</h3>
                                <p>{!! nl2br(e($item->content)) !!}</p>
                            </div>

                            @if($cycleItem)
                                <div class="egresados-cycle-panel">
                                    <div class="egresados-cycle-panel-title">{{ $cycleItem->title }}</div>

                                    <div class="egresados-cycle-list">
                                        @foreach($cycleBlocks as $block)
                                            @php
                                                $cleanBlock = preg_replace('/\s+/', ' ', $block);
                                                preg_match('/^(Ciclo\s+[IVXLCDM]+):\s*(.*)$/i', $cleanBlock, $cycleMatch);
                                                $cycleTitle = $cycleMatch[1] ?? $cycleItem->title;
                                                $cycleDetail = $cycleMatch[2] ?? $cleanBlock;

                                                $detailParts = preg_split('/\.\s*(Prerrequisitos?:)/i', $cycleDetail, 2, PREG_SPLIT_DELIM_CAPTURE);
                                                $subjectsText = trim($detailParts[0] ?? '');
                                                $requirementsText = null;

                                                if (count($detailParts) >= 3) {
                                                    $requirementsText = trim($detailParts[1] . ' ' . $detailParts[2]);
                                                    $requirementsText = rtrim($requirementsText, '.');
                                                }
                                            @endphp

                                            <div class="egresados-cycle-item">
                                                <h4>{{ $cycleTitle }}</h4>

                                                @if($subjectsText)
                                                    <p class="egresados-cycle-subjects">{{ $subjectsText }}</p>
                                                @endif

                                                @if($requirementsText)
                                                    <p class="egresados-cycle-prereq">{{ $requirementsText }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($aspirante && $aspirante->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Ingreso a la carrera</span>
                    <h2 class="page-section-title">{{ $aspirante->title }}</h2>
                    <p class="page-section-text">{{ $aspirante->content }}</p>
                </div>

                <div class="perfil-aspirante-grid">
                    @foreach($aspirante->items as $item)
                        <article class="perfil-aspirante-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($egresado)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="alert-card">
                    <h2 class="alert-card-title">{{ $egresado->title }}</h2>
                    <p class="alert-card-text">{!! nl2br(e($egresado->content)) !!}</p>

                    @if($egresado->button_text && $egresado->button_link)
                        <div style="margin-top: 1.25rem;">
                            <a href="{{ $egresado->button_link }}" class="home-plan-button">
                                {{ $egresado->button_text }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if($preegresoIntro)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Etapa final</span>
                    <h2 class="page-section-title">{{ $preegresoIntro->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($preegresoIntro->content)) !!}</p>
                </div>
            </div>
        </section>
    @endif

    @if($trabajos && $trabajos->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Trabajos de grado</span>
                    <h2 class="page-section-title">{{ $trabajos->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($trabajos->content)) !!}</p>
                </div>

                <div class="downloads-grid">
                    @foreach($trabajos->items as $item)
                        <article class="download-card">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="download-card-image">
                            @endif
                            <h3 class="download-card-title">{{ $item->title }}</h3>
                            <p class="download-card-text">{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssIntro)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="plan-summary-box">
                    <div>
                        <h2 class="page-section-title">{{ $ssIntro->title }}</h2>
                        <p class="page-section-text">{!! nl2br(e($ssIntro->content)) !!}</p>
                    </div>
                    <div class="plan-summary-stats">
                        @if($ssIntro->extra_1)
                            <div class="plan-stat-card"><strong>{{ $ssIntro->extra_1 }}</strong></div>
                        @endif
                        @if($ssIntro->extra_2)
                            <div class="plan-stat-card"><strong>{{ $ssIntro->extra_2 }}</strong></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($ssReq && $ssReq->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Servicio social</span>
                    <h2 class="page-section-title">{{ $ssReq->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssReq->content)) !!}</p>
                </div>
                <div class="perfil-list-box">
                    @foreach($ssReq->items as $item)
                        <div class="perfil-list-item">
                            <strong>{{ $item->subtitle ?: $item->title }}</strong>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssObj && $ssObj->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Objetivos</span>
                    <h2 class="page-section-title">{{ $ssObj->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssObj->content)) !!}</p>
                </div>
                <div class="perfil-aspirante-grid">
                    @foreach($ssObj->items as $item)
                        <article class="perfil-aspirante-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssMod && $ssMod->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Modalidades</span>
                    <h2 class="page-section-title">{{ $ssMod->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssMod->content)) !!}</p>
                </div>
                <div class="perfil-aspirante-grid">
                    @foreach($ssMod->items as $item)
                        <article class="perfil-aspirante-card">
                            <h3>{{ $item->title }}</h3>
                            <p>{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($ssPas && $ssPas->items->count())
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="section-heading">
                    <span class="home-section-badge">Tramite</span>
                    <h2 class="page-section-title">{{ $ssPas->title }}</h2>
                    <p class="page-section-text">{!! nl2br(e($ssPas->content)) !!}</p>
                </div>
                <div class="steps-grid">
                    @foreach($ssPas->items as $item)
                        <article class="step-card">
                            <div class="step-card-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="step-card-title">{{ $item->title }}</h3>
                            <p class="step-card-text">{!! nl2br(e($item->content)) !!}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($cta)
        <section class="page-section pt-0">
            <div class="public-container">
                <div class="alert-card">
                    <h2 class="alert-card-title">{{ $cta->title }}</h2>
                    <p class="alert-card-text">{!! nl2br(e($cta->content)) !!}</p>
                    @if($cta->button_text && $cta->button_link)
                        <div style="margin-top: 1.25rem;">
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
