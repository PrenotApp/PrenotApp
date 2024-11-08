@extends('layouts.app')

@section('links')
    @vite(['resources/sass/items/trashed.scss'])
@endsection

@section('content')
<div class="main-container">
    <section class="content-container">
        @foreach($items as $item)
            <article>
                <p class="d-inline me-3"><i class="{{$item->category->icon}} me-2"></i>{{ $item->name }}</p>
                <div class="d-inline">
                    <form action="{{route('item.restore',$item->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')

                        <button class="btn btn-warning" type="submit">Ripristina</button>
                    </form>
                    <form action="{{route('item.destroy',$item->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger" type="submit">Elimina</button>
                    </form>
                </div>
            </article>
        @endforeach
        @if (count($items) == 0)
            <p class="text-center">Nessun articolo eliminato</p>
        @endif
    </section>
</div>
@endsection
