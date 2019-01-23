@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Ver Todos <small>Timeline Equipamento</small></h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">TimeLine</a></li>
  <li class="active">Equipamento</li>
</ol>
@stop

@section('content')
<div class="row">
  <div class="col-md-9">
    <ul class="timeline">
      @foreach ($timelines as $timeline)
      <?php
      $datecomplet = strtotime($timeline->created_at);
      $data = date("d/m/Y", $datecomplet);
      $hora = date("H:i", $datecomplet);
      ?>

      <li class="time-label">
        <span class="bg-yellow">
          {{$data}}
        </span>
      </li>

      <li>
        <i class="{{ $timeline->TIMELINE_ICON}}"></i>
        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> {{$hora}}</span>
          <h3 class="timeline-header">EQP #{{ $timeline->TIMELINE_IDPRUMADA}} | <a href="#">{{ $timeline->TIMELINE_USER}}</a> {{ $timeline->TIMELINE_DESCRICAO}}</h3>
        </div>
      </li>
      @endforeach

      <li>
        <i class="fa fa-clock-o bg-gray"></i>
      </li>
    </ul>

    {!! $timelines->links() !!}
    <p>
      Exibindo {{ $timelines->count() }}  de {{ $timelines->total() }}.
    </p>

  </div>

  <div class="col-md-3">

    <a href="{{ route('Adicionar TimeLine Equipamento') }}" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Adicionar Ocorrência</a>
    <a href="{{ route('Timeline Buscar Equipamento') }}" class="btn btn-block btn-danger"><i class="fa fa-reply  "></i> Voltar</a>

  </div>

</div>
@stop
