@extends('layouts.app')

@section('content')
    @if(Auth::user()->role !== 'common')
        <section class="myContainer">
            <h6>Modifica articolo</h6>

            <form action="{{ route('item.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="inputContainer">
                    <label for="category_id">Categoria</label>
                    <select name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if ($category->id == old('category_id', $item->category_id))
                                    selected
                                @endif
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="inputContainer">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}">
                </div>

                <div class="inputContainer">
                    <label>Aggiungi al gruppo</label>
                    <select name="rack_id" id="rack_id">
                        <option value="" selected>Nessuno</option>
                        @foreach($racks as $rack)
                            <option value="{{ $rack->id }}"
                                @if(old('rack_id', $item->rack_id) == $rack->id){
                                    selected
                                }
                                @endif
                                >{{ $rack->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="submit">Modifica articolo</button>
            </form>
        </section>
    @else
        {{@abort(403)}}
    @endif
@endsection
