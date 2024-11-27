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
        <h3 class="code">codice: {{$school->code}}</h3>
        <div class="content-container">
            <a class="submit" href="{{ route('category.create') }}">
                Crea categoria
            </a>
            <a class="submit" href="{{ route('item.create') }}">
                Aggiungi articolo
            </a>
            <a class="btn btn-warning d-flex align-items-center" href="{{ route('item.trashed') }}">
                <i class="fa-solid fa-trash"></i>
            </a>
        </div>
    </section>
    @endif

    <section class="main-container" id="index">
        <div class="accordion content-container" id="accordionCategories">
            @foreach ($categories as $category)
            @php
                $categoryItems = $category->items;
            @endphp
            <div class="accordion-item mb-4">
                <h2 class="accordion-header" id="heading-{{ Str::slug($category) }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ Str::slug($category) }}" aria-expanded="false" aria-controls="collapse-{{ Str::slug($category) }}">
                        <i class="{{ $category->icon }}"></i><span>{{ $category->name }} ({{ count($categoryItems) }})</span>
                    </button>
                </h2>
                <div id="collapse-{{ Str::slug($category) }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ Str::slug($category) }}">
                    <div class="accordion-body">
                        <ul>
                            @foreach ($categoryItems as $index => $categoryItem)
                                <li>
                                    <a href="{{ route('item.show', $categoryItem->id) }}">{{ $categoryItem->name }}</a>
                                    <div>
                                        @if(Auth::check() && Auth::user()->role !== 'common')
                                        <a class="btn btn-warning" href="{{ route('item.edit', $categoryItem->id) }}">Modifica</a>
                                        @endif
                                        <a class="btn btn-primary" href="{{ route('booking.create', $categoryItem->id) }}">Prenota</a>
                                    </div>
                                </li>
                                @if ($index < count($categoryItems) - 1)
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
                            @foreach($racks as $index => $rack)
                                <div>
                                    <h2 id="headingRack-{{ $rack->id }}">
                                        <section class="rack-section">
                                            <h4 data-bs-toggle="collapse" data-bs-target="#collapseRack-{{ $rack->id }}" aria-expanded="false" aria-controls="collapseRack-{{ $rack->id }}">
                                                {{ $rack->name }}
                                            </h4>
                                            <div class="d-flex">
                                                @if(Auth::check() && Auth::user()->role !== 'common')
                                                    <form action="{{ route('rack.delete', $rack->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-danger" type="submit">Elimina</button>
                                                    </form>
                                                @endif

                                                @if(Auth::check() && Auth::user()->role !== 'common')
                                                <a class="btn btn-warning ms-3" href="{{ route('rack.edit', $rack) }}">Modifica</a>
                                                @endif
                                                <a class="btn btn-primary ms-3" href="{{ route('rack.booking', $rack->id) }}">Prenota</a>
                                            </div>
                                        </section>
                                    </h2>

                                    <div id="collapseRack-{{ $rack->id }}" class="accordion-collapse collapse" aria-labelledby="headingRack-{{ $rack->id }}">
                                        <div class="accordion-body last-body">
                                            <ul>
                                                @php
                                                    // Filtra solo gli items che appartengono al rack corrente
                                                    $rackItems = $rack->items
                                                @endphp
                                                @foreach ($rackItems as $rackItem)
                                                    <li>
                                                        <p class="racks-item"><i class="{{ $rackItem->category->icon }}"></i>{{ $rackItem->name }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if ($index < count($racks) - 1)
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
