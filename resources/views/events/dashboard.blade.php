@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if( count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do evento</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</th>
                    <td scope="row"><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>0</td>
                    <td><a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pen">Editar</i></a> <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Deletar</a> </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else

    <p>Você não tem nenhum evento, <a href={{ route('events.create')}}>Click aqui para criar.</a></p>
    @endif

</div>

@endsection
