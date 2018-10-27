@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1>Equipamento #01 <small>Timeline</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Equipamento #01</a></li>
        <li class="active">Timeline</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-9">
            <!-- The time line -->

            <ul class="timeline">

                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-yellow">
                    10 Out. 2018
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-check bg-green"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Rildo Ferreira</a> atualizou o status do hidrômetro para <span class="text-primary">Configurado/Ativo</span></h3>

                        <!-- <div class="timeline-body">
                            Hidrômetro foi ativado no condomínio.
                        </div> -->
                    </div>
                </li>
                <!-- END timeline item -->

                <!-- timeline item -->
                <li>
                    <i class="fa fa-file-zip-o bg-aqua"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 11:22</span>

                        <h3 class="timeline-header"><a href="#">Rildo Ferreira</a> vinculou o hidrômetro ao <a href="" class="text-primary">Condomínio Jardim das Flores</a></h3>
                    </div>
                </li>
                <!-- END timeline item -->

                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-yellow">
                    03 Out. 2018
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-truck bg-purple"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 09:37</span>

                        <h3 class="timeline-header"><a href="#">Rildo Ferreira</a> atualizou o status do hidrômetro para <span class="text-primary">Configurado/Em estoque</span></h3>

                        <div class="timeline-body">
                            Hidrômetro está disponível para instalação na central.
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-money bg-green"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 08:02</span>

                        <h3 class="timeline-header"><a href="#">Rildo Ferreira</a> cadastrou um hidrômetro <a href="" class="text-primary">#01</a></h3>

                        <div class="timeline-body">
                            Hidrômetro adquirido via leilão.
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div><!-- /.col-md-9 -->

        <div class="col-md-3">

            <button type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Adicionar Ocorrência</button>

            <button type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

        </div>

    </div>
@stop