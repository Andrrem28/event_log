@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="post" enctype="multipart/form-data">
        @csrf

        @if(session('msg-error'))
            <p class="msg-error">{{ session('msg-error')}}</p>
        @endif

        <div class="form-group py-2">
            <label for="image">Imagem do evento:</label>
            <input class="form-control-file" type="file" id="image" name="image">
        </div>
        <div class="form-group py-2">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Nome do evento">
        </div>

        <div class="form-group py-2">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Nome do evento">
        </div>

        <div class="form-group py-2">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="Nome da cidade">
        </div>

        <div class="form-group py-2">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div class="form-group py-2">
            <label for="description">Descrição do evento:</label>
            <textarea type="text" class="form-control" name="description" id="description" placeholder="Descrição do evento"></textarea>
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
                <input type="checkbox" name="items[]" value="Bebida Grátis"> Bebida grátis.
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Comida Grátis"> Comida grátis.
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes.
            </div>
        </div>

        <input type="submit" class="btn btn-success" value="Criar evento">

    </form>
</div>

@endsection
