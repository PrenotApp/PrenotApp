@extends('layouts.app')

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

        <a href="{{ route('item.create') }}">
            Aggiungi dispositivo
        </a>
        <a href="{{ route('category.create') }}">
            Aggiungi categoria
        </a>
        <a href="{{ route('rack.create') }}">
            Aggiungi gruppo
        </a>
    @endif

    @foreach ($groupedItems as $category => $items)
        <h2><i class="{{ $items[0]->category_icon }}"></i>{{ $category }}</h2>
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a>
                    <a href="{{ route('item.edit', $item->id) }}">Modifica</a>
                    <a href="{{ route('booking.create', $item->id) }}">Prenota</a>
                </li>
            @endforeach
        </ul>
    @endforeach

    @foreach($racks as $rack)
        <h2>{{ $rack->name }} <a href="{{ route('rack.edit',$rack) }}">Modifica</a><a href="{{ route('rack.booking',$rack->id) }}">Prenota</a></h2>
        <ul>
            @php
                $rackItems = $rack->items
            @endphp
            @foreach($rackItems as $rackItem)
                <li>{{$rackItem->name}}</li>
            @endforeach
        </ul>
    @endforeach
@endsection
