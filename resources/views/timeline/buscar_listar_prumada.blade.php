@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>TimeLine <small>TimeLine Equipamento</small></h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">TimeLine</a></li>
	<li class="active">Buscar TimeLine</li>
</ol>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-filter"></i> Filtro:</h3>
			</div>

			<div class="box-body">
				{!! Form::open(['id' => 'filtroImoveis']) !!}
				<div class="row">
					<div class="col-md-4">
						<!-- Imóvel -->
						<div class="form-group">
							{{ Form::label('PRU_IDIMOVEL', 'Imóvel') }}
							{{ Form::select('PRU_IDIMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}
						</div>
					</div>

					<div class="col-md-4">
						<!-- Agrupamento -->
						<div class="form-group">
							{{ Form::label('PRU_IDAGRUPAMENTO', 'Agrupamento') }}
							{{ Form::select('PRU_IDAGRUPAMENTO', ['' => 'Selecionar Agrupamento'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}
						</div>
					</div>

					<div class="col-md-4">
						<!-- Unidade -->
						<div class="form-group">
							{{ Form::label('PRU_IDUNIDADE', 'Unidade') }}
							{{ Form::select('PRU_IDUNIDADE', ['' => 'Selecionar Unidade'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}
						</div>
					</div>

					<div class="col-md-4">
						<!-- Equipamento -->
						<div class="form-group">
							{{ Form::label('TIMELINE_IDPRUMADA', 'Equipamento') }}
							{{ Form::select('TIMELINE_IDPRUMADA', ['' => 'Selecionar Equipamento'], null, ['class' => 'avalidate form-control', 'placeholder' => 'Escolha uma equipamento', 'id' => 'TIMELINE_IDPRUMADA']) }}

						</div>
					</div>

					<div class="col-md-4">
						<!-- Botão Filtrar -->
						<div class="form-group">
							{{ Form::label('', '&nbsp;') }}
							{{ Form::button('<i class="fa fa-filter"></i> Filtrar', ['class' => 'btn btn-default', 'style' => 'width: 100%;', 'id' => 'submitFiltroTimeline']) }}
						</div>
					</div>

					<div class="col-md-2">
						<!-- Botão ver todos -->
						<div class="form-group">
							{{ Form::label('', '&nbsp;') }}
							<a href="{{ route('Timeline Equipamento') }}" class="btn btn-block btn-primary"><i class="fa fa-eye"></i> Ver Todos</a>
						</div>
					</div>

					<div class="col-md-2">
						<!-- Botão add -->
						<div class="form-group">
							{{ Form::label('', '&nbsp;') }}
							<a href="{{ route('Adicionar TimeLine Equipamento') }}" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Adicionar Ocorrência</a>
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="col-md-12">

		<ul class="timeline">
			<div id="resultadoPesquisaTIMELINE">
				<p style="text-align: center;">Sem resultados para mostrar</p>
			</div>
			<li>
				<i class="fa fa-clock-o bg-gray"></i>
			</li>
		</ul>
	</div>

</div>
@stop
