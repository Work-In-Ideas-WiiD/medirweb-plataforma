@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}
{!! Html::style( asset('css/correct_content.css')) !!}

@section('content')
    <div class="col-md-8 row leitura_unidade">
    	<div class="col-md-12">
    		<div class="box box-primary">

            	<div class="box-header with-border">
              		<i class="fa fa-text-width"></i>
              		<h3 class="box-title">Geral</h3>
            	</div> <!-- /.box-header -->

            	<div class="box-body">
              		<dl>
                		<dt>Proprietário</dt>
                			<dd class="infoprop" >{{ $unidade->UNI_RESPONSAVEL }} - {{ $unidade->UNI_CPFRESPONSAVEL }} - {{ $unidade->UNI_TELRESPONSAVEL }}</dd>
                		<dt>Idenficação do Apartamento</dt>
						<dd class="infoprop" ><a class="linkbread" href="{{  url('/imovel/ver/'.$imovel->IMO_ID) }}">{{ $unidade->UNI_NOME }} - {{ $agrupamento->AGR_NOME }} - {{ $imovel->IMO_NOME }}</a></dd>
              		</dl>
            	</div> <!-- /.box-body -->

          </div> <!-- /.box-primary -->

          <div class="box box-success" id="boxdeacoes">

            	<div class="box-header with-border">
              		<i class="fa fa-external-link"></i>
              		<h3 class="box-title">Ações</h3>
            	</div> <!-- /.box-header -->

            	<div class="box-body row">
              		<div class="col-md-3 text-center">
              			<div class="form-group">
                  			<select class="form-control">
                  				<option>(Selecione a referência)</option>
                    			<option selected="">Agosto/2018</option>
                    			<option>Julho/2018</option>
                    			<option>Junho/2018</option>
                    			<option>Maio/2018</option>
                    			<option>Abril/2018</option>
                    			<option>Março/2018</option>
                    			<option>Fevereiro/2018</option>
                    			<option>Janeiro/2018</option>
                    			<option>Dezembro/2017</option>
                    			<option>Novembro/2017</option>
                  			</select>
                		</div>
              		</div>
              		<div class="col-md-3 text-center">
              			<a href="{{ url('/unidade/leitura/'.$unidade->UNI_ID) }}" class="btn btn-default"><i class="fa fa-retweet"></i> Leitura</a>
              		</div>
					@if($unidade->getPrumadas()->count() > 0 )
						@if($unidade->getPrumadas()->first()->PRU_STATUS == 1)
							<div class="col-md-3 text-center">
								<a href="{{ url('/unidade/desligar/'.$unidade->UNI_ID) }}" class="btn btn-danger"><i class="fa fa-close"></i> Efetuar corte</a>
							</div>
						@else
							<div class="col-md-3 text-center">
								<a href="{{ url('/unidade/ligar/'.$unidade->UNI_ID) }}" class="btn btn-success"><i class="fa fa-power-off"></i> Ativação</a>
							</div>
						@endif
					@else
						<div class="col-md-3 text-center">
							<a href="" class="btn btn-danger"><i class="fa fa-close"></i> Efetuar corte</a>
						</div>
					@endif
              		<div class="col-md-3 text-center">
              			<a href="#" class="btn btn-default" disabled><i class="fa fa-calculator"></i> Faturamento</a>
              		</div>
            	</div> <!-- /.box-body -->

          </div> <!-- /.box-primary -->

          <div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-tachometer"></i> Consumo atual (m³) @if($unidade->getPrumadas()->count() > 0 ) @if($unidade->getPrumadas()->first()->PRU_STATUS == 1) <i class="fa fa-circle" style="color: #009900;"></i> @else <i class="fa fa-circle" style="color: #d73925;"></i> @endif @endif</h3>
			</div>

			<div class="box-body">
				<div class="bloco-medicao row">
					<div class="col-md-5">

						<div class="medicao-num">

							@if(isset($ultimaleitura->LEI_METRO))
								<p class="registronum" >{{ sprintf("%04d", $ultimaleitura->LEI_METRO) }} <span class="unidade" >m³</span></p>
							@else
								<p class="registronum" >0000 <span class="unidade" >m³</span></p>
							@endif

						</div>
						<!--<p style="margin-top: 0.8em;"><a class="btn btn-flat btn-default" href="" alt="Adicionar Agrupamento" style="width: 100%;" ><i class="fa fa-edit"></i> Editar informações</a></p>-->
					</div>

					<div class="col-md-7">

						<div class="medicao-num">
							<table class="table" >
							<tbody>
								<tr>
									<th>LEITURA ANTERIOR: <b>0000</b></th>
									<th>DATA: <b>00/00/0000</b></th>
								</tr>
							</tbody>
							</table>
						</div>

						<div class="medicao-num">
							<table class="table" >
							<tbody>
								<tr>
									<th>LEITURA ANTERIOR: <b>0000</b></th>
									<th>DATA: <b>00/00/0000</b></th>
								</tr>
							</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
    	</div> <!-- /.col-md-12 -->

    	<div class="col-md-12">
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-hourglass-1"></i> Histórico de Leituras</h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered" id="tabelaPrincipal">
						<thead>
							<th>#</th>
							<th>m³</th>
							<th>lt</th>
							<th>dl</th>
							{{--<th>Leitura</th>--}}
							<th>Data da Leitura</th>
						</thead>
						<tbody>

							@foreach ($leituras as $lei)
							<tr>
								<td>{{ $lei->LEI_ID }}</td>
								<td>{{ $lei->LEI_METRO }}</td>
								<td>{{ $lei->LEI_LITRO }}</td>
								<td>{{ $lei->LEI_MILILITRO }}</td>
								{{--<td>{{ $lei->LEI_VALOR }}</td>--}}
								<td>{{ $lei->created_at->format('d/m/Y H:i') }}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-tachometer"></i> Análise gráfica</h3>
				</div>
				<div class="box-body">
					<canvas id="grafico" style="width: 100%; height: 23.5rem;"></canvas>
				</div>
			</div>
		</div>
    </div>

	<div class="col-md-4 row">

		<div class="col-md-12">
    		<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-tachometer"></i> Prumadas</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								@if(count($prumadas) > 0)
									@foreach ($prumadas as $pru)
										<div class="col-md-12 col-sm-12 col-xs-12">
          									<div class="info-box bg-aqua pru-box">
	            								<span class="info-box-icon"><i class="fa fa-tachometer"></i></span>
            									<div class="info-box-content">
	              									<span class="info-box-text">Medidor #1</span>
													@if(isset($ultimaleitura->LEI_METRO))
														<span class="info-box-number">{{ sprintf("%04d", $ultimaleitura->LEI_METRO) }}</span>
													@else
														<span class="info-box-number">0000</span>
													@endif
              										<div class="progress">
	                									<div class="progress-bar" style="width: 70%"></div>
              										</div>
                  									<span class="progress-description">
														@if(isset($ultimaleitura->created_at))
															{{ $ultimaleitura->created_at->format('d/m/Y H:i') }}
														@else
															00/00/00 - 00:00
														@endif

                  									</span>
            									</div>
            								<!-- /.info-box-content -->
          									</div>
          								<!-- /.info-box -->
        								</div>
									@endforeach
								@else
									<p style="text-align: center;" >Não há registros.</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
    		<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-hourglass-1"></i> Histórico de consumo mensal</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>MÊS</th>
										<th>LEITURA</th>
									</tr>
									<tr>
										<td>JUL/2018</td>
										<td>0000</td>
									</tr>
									<tr>
										<td>JUN/2018</td>
										<td>0000</td>
									</tr>
									<tr>
										<td>MAI/2018</td>
										<td>0000</td>
									</tr>
									<tr>
										<td>ABR/2018</td>
										<td>0000</td>
									</tr>
									<tr>
										<td>MAR/2018</td>
										<td>0000</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

@stop

@section('footer')
<footer class="main-footer">
	<div class="pull-right hidden-xs">
  	<b>Version</b> 2.4.0
	</div>
	<strong>Copyright © 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
reserved.
</footer>
@stop
