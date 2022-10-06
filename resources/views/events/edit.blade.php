@extends('layouts.main')

@section('title', 'Editando' . $event->title)

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $event->title }}</h1>
    <form action="{{ route('events.update', $event->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        @if(session('msg-error'))
            <p class="msg-error">{{ session('msg-error')}}</p>
        @endif

        <div class="form-group py-2">
            <label for="image">Imagem do evento:</label>
            <input class="form-control-file" type="file" id="image" name="image">
            <img src="/img/events/{{$event->image}}" alt="{{ $event->title }}" class="img-preview">
        </div>
        <div class="form-group py-2">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Nome do evento" value="{{ $event->title }}">
        </div>

        <div class="form-group py-2">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Data do evento" value="{{ $event->date->format('Y-m-d') }}">
        </div>

        <div class="form-group py-2">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="Nome da cidade" value="{{ $event->city }}">
        </div>

        <div class="form-group py-2">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0" {{ $event->private == 0 ? "selected='selected'" : "" }}>Não</option>
                <option value="1" {{ $event->private == 1 ? "selected='selected'" : "" }}>Sim</option>
            </select>
        </div>

        <div class="form-group py-2">
            <label for="description">Descrição do evento:</label>
            <textarea type="text" class="form-control" name="description" id="description" placeholder="Descrição do evento">{{$event->description}}</textarea>
        </div>

        <div class="form-group py-2">
            <label for="title " class="py-2">Adicione Itens de infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras.
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco.
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Bebida grátis"> Bebida grátis.
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Comida grátis"> Comida grátis.
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes.
            </div>
        </div>

        <input type="submit" class="btn btn-success" value="Editar evento">

    </form>
</div>
@endsection

