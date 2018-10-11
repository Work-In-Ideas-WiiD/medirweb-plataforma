@extends('adminlte::page')

@section('title', 'AdminLTE')

{!! Html::style( asset('css/total.css')) !!}

@section('content')
	<div class="col-md-12">
		<div class="panel box box-primary">
	      <div class="box-header with-border collaptitlr">
	      	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed" >
	        <h4 class="box-title pull-left">
	          <i class="fa fa-building"></i>
	            {{ $imovel->IMO_NOME }}
	        </h4>
	        <i class="fa fa-chevron-down pull-right"></i>
	        </a>
	      </div>
	      <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
	        <div class="box-body">
	          <div class="row">

	          	<!-- Infomação -->
	          	<div class="col-md-4">
	          		<div class="bloco-imovel-info">
						<p class="titulo"><i class="fa fa-map"></i> <b>Localização</b></p>
						<p>{{ $imovel->IMO_ENDERECO }}</p>
						<p>{{ $imovel->IMO_COMPLEMENTO }}</p>
						<p>{{ $imovel->IMO_IDCIDADE }} - {{ $imovel->IMO_IDESTADO }}</p>
						<p>{{ $imovel->IMO_CEP }}</p>
	          		</div>
	          	</div>
	          	<!-- FIM Informação -->

	          	<!-- Infomação -->
	          	<div class="col-md-4">
	          		<div class="bloco-imovel-info">
						<p class="titulo"><b><i class="fa fa-user"></i> Responsáveis</b></p>
						<p>{!! $imovel->IMO_RESPONSAVEIS !!}</p>
	          		</div>
	          	</div>
	          	<!-- FIM Informação -->

	          	<!-- Infomação -->
	          	<div class="col-md-4">
	          		<div class="bloco-imovel-info">
						<p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
						<p>{!! $imovel->IMO_TELEFONES !!}</p>
	          		</div>
	          	</div>
	          	<!-- FIM Informação -->
	          	
	          </div>
	        </div>
	      </div>
	    </div>
	</div>




	<!-- <div class="col-md-12">
		<div class="box box-primary">
			<p class="bloco-imovel-cad">
				<i class="fa fa-institution"></i>
			</p>
			<div class="bloco-imovel-info">
				<p class="titulo"><i class="fa fa-map"></i> <b>Localização</b></p>
				<p>{{ $imovel->IMO_ENDERECO }}</p>
				<p>{{ $imovel->IMO_COMPLEMENTO }}</p>
				<p>{{ $imovel->IMO_IDCIDADE }} - {{ $imovel->IMO_IDESTADO }}</p>
				<p>{{ $imovel->IMO_CEP }}</p>
				<p class="titulo"><b><i class="fa fa-user"></i> Responsáveis</b></p>
				<p>{!! $imovel->IMO_RESPONSAVEIS !!}</p>
				<p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
				<p>{!! $imovel->IMO_TELEFONES !!}</p>
				<p style="margin-top: 0.8em;"><a class="btn btn-flat btn-default" href="{{ route('imovel.edit', ['user' => $imovel->IMO_ID]) }}" alt="Adicionar Agrupamento" style="width: 100%;" ><i class="fa fa-edit"></i> Editar informações</a></p>
			</div>
		</div>
	</div> -->

    <div class="col-md-12">
    	<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">Torre 3</a></li>
              <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Torre 2</a></li>
              <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Torre 1</a></li>

              <!-- Ações extras -->
              <!-- <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                  Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>
              </li> -->

              <li class="pull-left header"><h4><i class="fa fa-th-large"></i> Unidades<h4></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                <div class="row">

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

					<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->

                	<!-- Unidade -->
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>APT 101</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="http://google.com"><p class="valor">0002240</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	<!-- FIM Unidade -->                	

                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
              	<div class="row">
                	<div class="col-md-12">
                		<p class="text-center" >Não há registros.</p>
                	</div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
                <div class="row">
                	<div class="col-md-12">
                		<p class="text-center" >Não há registros.</p>
                	</div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>



    	<!-- <div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-building"></i> Agrupamentos</h3>
			</div>
    		{!! Form::open(['action' => 'ImovelController@store', 'method' => 'POST']) !!}
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							@foreach ($agrupamentos as $agrupamento)
    							<div class="col-md-4 agrupamento">
    								<a href="{{ url('agrupamento/ver/') }}/{{ $agrupamento->AGR_ID }}" alt="{{ $agrupamento->AGR_NOME }}" >
    								<p class="bloco-agrupamento-vis">
										<i class="fa fa-building"></i>
										<p style="">{{ $agrupamento->AGR_NOME }}</p>
									</p>
									</a>
    							</div>
							@endforeach
						</div>
					</div>

				</div> -->
			</div> <!-- /.box-body -->
			<!-- <div class="box-footer">
				<a class="btn btn-primary pull-right" href="{{ url('agrupamento/adicionar') }}" alt="Adicionar Agrupamento" >Adicionar Agrupamento</a>
			</div><!-- /.box-footer -->
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
@stop