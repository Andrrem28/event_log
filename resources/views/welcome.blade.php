@extends('layouts.main')

@section('title', 'Lista de Eventos')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/" method="get">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
       <h4>Eventos relacionados a busca: {{$search}}</h4>
    @else
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif
    <h2>Próximos Eventos</h2>
    <div id="cards-container" class="row">
        @foreach ($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}">
            <div class="card-body">
               <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
               <h5 class="card-title">{{ $event->title }}</h5>
               <p class="card-participants">{{count($event->users)}} Participantes</p>
               <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber Mais</a>
            </div>
        </div>
        @endforeach

        @if(count($events) == 0 && $search)
            <p>Nenhum evento localizado referente a {{ $search }}! <br> <a href="/" class="btn btn-primary">Ver todos.</a></p>
        @elseif(count($events) == 0)
            <p>No momento não há nenhum evento disponível</p>
        @endif
    </div>
</div>
@endsection
