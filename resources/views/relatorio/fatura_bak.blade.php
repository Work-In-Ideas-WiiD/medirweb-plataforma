@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}
{!! Html::style( asset('css/correct_content2.css')) !!}

@section('content')


    <div style="margin-bottom: 30px;">
        <h2 style="font-weight: 100; color: rgba(0,0,0,0.8);"><i class="fa fa-users"></i> LIQUIDAÇÃO DE FATURAS</h2>
        <hr />

        <div class="box box-gray" style="margin-top: -15px;">
            <div class="box-header with-border gray">
                <h3 class="box-title" style="font-weight: 300; font-size: 14px;"></i> Cliente: Cond. Águas Claras - DF</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class='box-body'>
                <div class='row'>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('CLI_DOCUMENTO', 'Data Inicio') }}
                            {{ Form::text('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('CLI_LOGRADOURO', 'Data Final') }}
                            {{ Form::text('CLI_LOGRADOURO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label>Data final do último fechamento 09/09/2018</label><br />
                            {{ Form::label('CLI_DOCUMENTO', 'PDV') }}
                            {{ Form::text('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            {{ Form::label('CLI_DOCUMENTO', 'Taxa Plataforma R$ 12,00') }}
                            {{ Form::checkbox('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_DOCUMENTO', 'Custo Água') }}
                            {{ Form::checkbox('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- /.box .box-primary -->

        <div class="row" style="margin-top: 40px; margin-bottom: 40px;">
            <div class="col-md-3">
                <div class="box box-success" style="margin-top: -15px;">
                    <div class="box-header with-border gray" style="background-color: #00a65a; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Consumo de Litros - Valor</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class='box-body'>
                        <h2 style="text-align: center; font-weight: 100; font-size: 19px;"><i class="fa fa-usd" style="border: 2px solid;border-radius: 180px; width: 24px; height: 24px; padding-top: 2px; margin-right: 7px;"></i> R$ 6.030,66</h2>
                    </div>
                </div><!-- /.box .box-primary -->
            </div>

            <div class="col-md-3">
                <div class="box box-warning" style="margin-top: -15px;">
                    <div class="box-header with-border gray" style="background-color: #f39c12; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Cota Consumo Área Comum</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class='box-body'>
                        <h2 style="text-align: center; font-weight: 100; font-size: 19px;"><i class="fa fa-usd" style="border: 2px solid;border-radius: 180px; width: 24px; height: 24px; padding-top: 2px; margin-right: 7px;"></i> R$ 469,77</h2>
                    </div>
                </div><!-- /.box .box-primary -->
            </div>

            <div class="col-md-3">
                <div class="box box-primary" style="margin-top: -15px;">
                    <div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> VAlor da Água $</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class='box-body' style="text-align: center;">
                        <h2 style="text-align: center; font-weight: 100; font-size: 19px;"><i class="fa fa-usd" style="border: 2px solid;border-radius: 180px; width: 24px; height: 24px; padding-top: 2px; margin-right: 7px;"></i> R$ 5.560,59</h2>
                        <button class="btn-danger btn" style="margin-top: 5px;"><i class="fa fa-save"></i> Salvar fechamento</button>
                    </div>
                </div><!-- /.box .box-primary -->
            </div>
            <div class="col-md-3">
                <div class="box box-danger" style="margin-top: -15px;">
                    <div class="box-header with-border gray" style="background-color: #dd4b39; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Exportar</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class='box-body'>
                        <div class="row">
                            <di class="col-md-6">
                                <button class="btn-default btn" style="margin-top: 5px; font-size: 10px;"><i class="fa fa-save"></i> PDF Cliente</button>
                            </di>
                            <di class="col-md-6">
                                <button class="btn-default btn" style="margin-top: 5px; font-size: 10px;"><i class="fa fa-save"></i> PDF Controle</button>
                            </di>
                            <di class="col-md-6">
                                <button class="btn-default btn" style="margin-top: 5px; font-size: 10px;"><i class="fa fa-save"></i> PDF Cliente</button>
                            </di>
                            <di class="col-md-6">
                                <button class="btn-default btn" style="margin-top: 5px; font-size: 10px;"><i class="fa fa-save"></i> PDF Controle</button>
                            </di>

                        </div>




                    </div>
                </div><!-- /.box .box-primary -->
            </div>
        </div>


    </div>

@stop