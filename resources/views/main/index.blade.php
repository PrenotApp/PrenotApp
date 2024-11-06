@extends('layouts.app')

@section('links')
    @vite(['resources/sass/main/index.scss'])

@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(Auth::check() && Auth::user()->role !== 'common')
    <section id="create" class="main-container">
        <div class="content-container">
            <a class="submit" href="{{ route('category.create') }}">
                Crea categoria
            </a>
            <a class="submit" href="{{ route('item.create') }}">
                Aggiungi dispositivo
            </a>
        </div>
    </section>
    @endif

    <section class="main-container" id="index">
        <div class="accordion content-container" id="accordionCategories">
            @foreach ($groupedItems as $category => $items)
            <div class="accordion-item mb-4">
                <h2 class="accordion-header" id="heading-{{ Str::slug($category) }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ Str::slug($category) }}" aria-expanded="false" aria-controls="collapse-{{ Str::slug($category) }}">
                        <i class="{{ $items[0]->category_icon }}"></i><span>{{ $category }} ({{ count($items) }})</span>
                    </button>
                </h2>
                <div id="collapse-{{ Str::slug($category) }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ Str::slug($category) }}">
                    <div class="accordion-body">
                        <ul>
                            @foreach ($items as $index => $item)
                            <li>
                                <a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a>
                                <div>
                                    @if(Auth::check() && Auth::user()->role !== 'common')
                                    <a class="btn btn-warning" href="{{ route('item.edit', $item->id) }}">Modifica</a>
                                    @endif
                                    <a class="btn btn-primary" href="{{ route('booking.create', $item->id) }}">Prenota</a>
                                </div>
                            </li>
                            @if ($index < count($items) - 1)
                                <hr>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="accordion content-container" id="accordionCarelli">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <div class="accordion-button last-accordion">
                        <h3><span>Carrelli</span>
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Clicca sul nome del carrello per visualizzare tutti i dipositivi che appartengono ad esso" data-bs-custom-class="custom-popover">
                                <div class="help-container" disabled><i class="fa-solid fa-question help"></i></div>
                            </span>
                        </h3>
                        @if(Auth::check() && Auth::user()->role !== 'common')
                        <a class="btn btn-add" href="{{ route('rack.create') }}"><i class="fa-solid fa-plus"></i></a>
                        @endif
                    </div>
                </h2>
                <div id="panelsStayOpen-collapseCarelli" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="accordion" id="accordionRacks">
                            @foreach($racks as $rack)
                                <div>
                                    <h2 id="headingRack-{{ $rack->id }}">
                                        <section class="rack-section">
                                            <h4 data-bs-toggle="collapse" data-bs-target="#collapseRack-{{ $rack->id }}" aria-expanded="false" aria-controls="collapseRack-{{ $rack->id }}">
                                                {{ $rack->name }}
                                            </h4>
                                            <div>
                                                @if(Auth::check() && Auth::user()->role !== 'common')
                                                <a class="btn btn-warning" href="{{ route('rack.edit', $rack) }}">Modifica</a>
                                                @endif
                                                <a class="btn btn-primary" href="{{ route('rack.booking', $rack->id) }}">Prenota</a>
                                            </div>
                                        </section>
                                    </h2>

                                    <div id="collapseRack-{{ $rack->id }}" class="accordion-collapse collapse" aria-labelledby="headingRack-{{ $rack->id }}">
                                        <div class="accordion-body last-body">
                                            <ul>
                                                @foreach ($groupedItems as $items)
                                                    @php
                                                        // Filtra solo gli items che appartengono al rack corrente
                                                        $filteredItems = array_filter($items, function($item) use ($rack) {
                                                            return $item->rack_id === $rack->id;
                                                        });
                                                    @endphp

                                                    @foreach ($filteredItems as $item)
                                                        <li>
                                                            <p class="racks-item"><span>&#9679;</span>{{ $item->name }}</p>
                                                        </li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
