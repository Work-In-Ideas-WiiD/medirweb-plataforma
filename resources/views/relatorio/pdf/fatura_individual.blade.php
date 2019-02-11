<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fatura Individual</title>

    <style>
    /*! Bootstrap CSS*/
    .col-md-1, .col-md-2, .col-md-2-4, .col-md-3, .col-md-4, .col-md-4-5, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
        float: left;
    }

    .col-md-2-5 {
        float: right;
        width: 20%;
    }

    .col-md-2-4 {
        width: 20%;
    }

    .col-md-12 {
        width: 100%;
    }
    .col-md-11 {
        width: 91.66666667%;
    }
    .col-md-10 {
        width: 83.33333333%;
    }
    .col-md-9 {
        width: 75%;
    }
    .col-md-8 {
        width: 66.66666667%;
    }
    .col-md-7 {
        width: 58.33333333%;
    }
    .col-md-6 {
        width: 50%;
    }
    .col-md-5 {
        width: 41.66666667%;
    }

    .col-md-4-5 {
        width: 36%;
    }

    .col-md-4 {
        width: 33.33333333%;
    }

    .col-md-3 {
        width: 25%;
    }
    .col-md-2 {
        width: 16.66666667%;
    }
    .col-md-1 {
        width: 8.33333333%;
    }

    /*!  BOX */
    .box {
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        border-top: 3px solid #d2d6de;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }
    .box.box-primary {
        border-top-color: #3c8dbc;
    }
    .box.box-info {
        border-top-color: #00c0ef;
    }
    .box.box-danger {
        border-top-color: #dd4b39;
    }
    .box.box-warning {
        border-top-color: #f39c12;
    }
    .box.box-success {
        border-top-color: #00a65a;
    }
    .box.box-default {
        border-top-color: #d2d6de;
    }
    .box.collapsed-box .box-body,
    .box.collapsed-box .box-footer {
        display: none;
    }
    .box .nav-stacked > li {
        border-bottom: 1px solid #f4f4f4;
        margin: 0;
    }
    .box .nav-stacked > li:last-of-type {
        border-bottom: none;
    }
    .box.height-control .box-body {
        max-height: 300px;
        overflow: auto;
    }
    .box .border-right {
        border-right: 1px solid #f4f4f4;
    }
    .box .border-left {
        border-left: 1px solid #f4f4f4;
    }
    .box.box-solid {
        border-top: 0;
    }
    .box.box-solid > .box-header .btn.btn-default {
        background: transparent;
    }
    .box.box-solid > .box-header .btn:hover,
    .box.box-solid > .box-header a:hover {
        background: rgba(0, 0, 0, 0.1);
    }
    .box.box-solid.box-default {
        border: 1px solid #d2d6de;
    }
    .box.box-solid.box-default > .box-header {
        color: #444444;
        background: #d2d6de;
        background-color: #d2d6de;
    }
    .box.box-solid.box-default > .box-header a,
    .box.box-solid.box-default > .box-header .btn {
        color: #444444;
    }
    .box.box-solid.box-primary {
        border: 1px solid #3c8dbc;
    }
    .box.box-solid.box-primary > .box-header {
        color: #ffffff;
        background: #3c8dbc;
        background-color: #3c8dbc;
    }
    .box.box-solid.box-primary > .box-header a,
    .box.box-solid.box-primary > .box-header .btn {
        color: #ffffff;
    }
    .box.box-solid.box-info {
        border: 1px solid #00c0ef;
    }
    .box.box-solid.box-info > .box-header {
        color: #ffffff;
        background: #00c0ef;
        background-color: #00c0ef;
    }
    .box.box-solid.box-info > .box-header a,
    .box.box-solid.box-info > .box-header .btn {
        color: #ffffff;
    }
    .box.box-solid.box-danger {
        border: 1px solid #dd4b39;
    }
    .box.box-solid.box-danger > .box-header {
        color: #ffffff;
        background: #dd4b39;
        background-color: #dd4b39;
    }
    .box.box-solid.box-danger > .box-header a,
    .box.box-solid.box-danger > .box-header .btn {
        color: #ffffff;
    }
    .box.box-solid.box-warning {
        border: 1px solid #f39c12;
    }
    .box.box-solid.box-warning > .box-header {
        color: #ffffff;
        background: #f39c12;
        background-color: #f39c12;
    }
    .box.box-solid.box-warning > .box-header a,
    .box.box-solid.box-warning > .box-header .btn {
        color: #ffffff;
    }
    .box.box-solid.box-success {
        border: 1px solid #00a65a;
    }
    .box.box-solid.box-success > .box-header {
        color: #ffffff;
        background: #00a65a;
        background-color: #00a65a;
    }
    .box.box-solid.box-success > .box-header a,
    .box.box-solid.box-success > .box-header .btn {
        color: #ffffff;
    }
    .box.box-solid > .box-header > .box-tools .btn {
        border: 0;
        box-shadow: none;
    }
    .box.box-solid[class*='bg'] > .box-header {
        color: #fff;
    }
    .box .box-group > .box {
        margin-bottom: 5px;
    }
    .box .knob-label {
        text-align: center;
        color: #333;
        font-weight: 100;
        font-size: 12px;
        margin-bottom: 0.3em;
    }
    .box > .overlay,
    .overlay-wrapper > .overlay,
    .box > .loading-img,
    .overlay-wrapper > .loading-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .box .overlay,
    .overlay-wrapper .overlay {
        z-index: 50;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 3px;
    }
    .box .overlay > .fa,
    .overlay-wrapper .overlay > .fa {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -15px;
        margin-top: -15px;
        color: #000;
        font-size: 30px;
    }
    .box .overlay.dark,
    .overlay-wrapper .overlay.dark {
        background: rgba(0, 0, 0, 0.5);
    }
    .box-header:before,
    .box-body:before,
    .box-footer:before,
    .box-header:after,
    .box-body:after,
    .box-footer:after {
        content: " ";
        display: table;
    }
    .box-header:after,
    .box-body:after,
    .box-footer:after {
        clear: both;
    }
    .box-header {
        color: #444;
        display: block;
        padding: 10px;
        position: relative;
    }
    .box-header.with-border {
        border-bottom: 1px solid #f4f4f4;
    }
    .collapsed-box .box-header.with-border {
        border-bottom: none;
    }
    .box-header > .fa,
    .box-header > .glyphicon,
    .box-header > .ion,
    .box-header .box-title {
        display: inline-block;
        font-size: 18px;
        margin: 0;
        line-height: 1;
    }
    .box-header > .fa,
    .box-header > .glyphicon,
    .box-header > .ion {
        margin-right: 5px;
    }
    .box-header > .box-tools {
        position: absolute;
        right: 10px;
        top: 5px;
    }
    .box-header > .box-tools [data-toggle="tooltip"] {
        position: relative;
    }
    .box-header > .box-tools.pull-right .dropdown-menu {
        right: 0;
        left: auto;
    }
    .box-header > .box-tools .dropdown-menu > li > a {
        color: #444!important;
    }
    .btn-box-tool {
        padding: 5px;
        font-size: 12px;
        background: transparent;
        color: #97a0b3;
    }
    .open .btn-box-tool,
    .btn-box-tool:hover {
        color: #606c84;
    }
    .btn-box-tool.btn:active {
        box-shadow: none;
    }
    .box-body {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        padding: 10px;
    }
    .no-header .box-body {
        border-top-right-radius: 3px;
        border-top-left-radius: 3px;
    }
    .box-body > .table {
        margin-bottom: 0;
    }
    .box-body .fc {
        margin-top: 5px;
    }
    .box-body .full-width-chart {
        margin: -19px;
    }
    .box-body.no-padding .full-width-chart {
        margin: -9px;
    }
    .box-body .box-pane {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 3px;
    }
    .box-body .box-pane-right {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 0;
    }

    .p-data {
        font-size: 12px;
        text-align:center;
        margin-bottom: -12px;
        margin-top: 0px;
    }

    .p-leitura {
        font-size: 12px;
        text-align:center;
        margin-bottom: 0px;
        margin-top: -18px;
    }

    .text-center {
        text-align:center;
    }

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th {
        padding: 15px;
        text-align: center;
    }

    td {
        padding: 10px;
        text-align: center;
    }

    </style>
</head>
<body>

    <?php // DADOS UNICOS (SEM REPETIR)
    $valorSemFormato = array();
    foreach ($dadosFaturaIndividual as $dados) {
        $nomeImovel = $dados['Imovel'];
        $cnpjImovel = $dados['cnpjImovel'];
        $enderecoImovel = $dados['Endereco'];
        $bairroImovel = $dados['Bairro'];
        $cityUfImovel = $dados['CityUF'];
        $cepImovel = $dados['CEP'];
        $responsaveisImovel = $dados['responsaveisImovel'];
        $responsaveisTelImovel = $dados['responsaveisTelImovel'];

        $nomeAp = $dados['nomeAp'];
        $responsavelAp = $dados['responsavelAp'];
        $responsavelCpfAp = $dados['responsavelCpfAp'];
        $responsavelTelAp = $dados['responsavelTelAp'];

        $arrayValorSemFormato = $dados['ValorSemFormato'];
        array_push($valorSemFormato, $arrayValorSemFormato);
    }
    //SOMA VALOR TOTAL
    $valorTotalSoma = array_sum(array_map(function($value){return (float)$value;},$valorSemFormato));
    $valorTotal = number_format($valorTotalSoma, 2, ',', '.');
    ?>

    <?php // Imovel ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $nomeImovel }}</h3>
            <div style="text-align:right; margin-top: -20px; position: relative;">
                <small>CNPJ: {{ $cnpjImovel }}</small>
            </div>
        </div>

        <div class='box-body'>
            <div class="col-md-4-5">
                <b>Localização</b><br><br>
                <small>{{ $enderecoImovel }}</small><br>
                <small>{{ $bairroImovel }}</small><br>
                <small>{{ $cityUfImovel }}</small><br>
                <small>{{ $cepImovel }}</small><br>
            </div>

            <div class="col-md-4-5">
                <b> Responsáveis</b><br><br>
                <small>{!! $responsaveisImovel !!}</small>
            </div>

            <div class="col-md-4-5">
                <b>Contato</b><br><br>
                <small>{!! $responsaveisTelImovel !!}</small>
            </div>

        </div>
    </div>

    <?php // Condomínio ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Condomínio</h3>
            <div style="text-align:right; margin-top: -20px; position: relative;">
                <small>{{ $nomeAp }}</small>
            </div>
        </div>
        <div class='box-body'>
            <div class="col-md-2">
                Apartamento:<br>
                Responsável:<br>
                CPF:<br>
                TELEFONE:<br>
            </div>
            <div class="col-md-4-5">
                <small>{{ $nomeAp }}</small><br>
                <small>{{ $responsavelAp }}</small><br>
                <small>{{ $responsavelCpfAp }}</small><br>
                <small>{{ $responsavelTelAp }}</small><br>
            </div>
        </div>
    </div>

    <?php // Consumo ?>
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Consumo</h3>
            <div style="text-align:right; margin-top: -20px; position: relative;">
                <small>{{ $nomeAp }}</small>
            </div>
        </div>
        <div class='box-body'>

            <div class="col-md-2-4">
                <p><b># Hidrômetro</b></p>
                @foreach($dadosFaturaIndividual as $hidro)
                <p>#{{ $hidro['PRU_ID'] }} - {{ $hidro['PRU_NOME'] }}</p>
                <hr>
                @endforeach
            </div>
            <div class="col-md-2-4">
                <p class="text-center"><b>Leitura Anterior</b></p>
                @foreach( $dadosFaturaIndividual as $leituraAnterior)
                <p class="p-leitura">
                    <p class='p-data'>{{ $leituraAnterior['DataLeituraAnterior'] }}</p>
                    <p class='text-center'>{{ $leituraAnterior['LeituraAnterior'] }}m³</p>
                </p>
                <hr>
                @endforeach
            </div>
            <div class="col-md-2-4">
                <p class="text-center"><b>Leitura Anterior</b></p>
                @foreach( $dadosFaturaIndividual as $leituraAtual)
                <p class="p-leitura">
                    <p class='p-data'>{{ $leituraAtual['DataLeituraAtual'] }}</p>
                    <p class='text-center'>{{ $leituraAtual['LeituraAtual'] }}m³</p>
                </p>
                <hr>
                @endforeach
            </div>
            <div class="col-md-2-4 text-center">
                <p><b>Consumo m³</b></p>
                @foreach($dadosFaturaIndividual as $consumo)
                <p>{{ $consumo['Consumo'] }}m³</p>
                <hr>
                @endforeach
            </div>
            <div class="col-md-2-4">
                <p><b>Valor</b></p>
                @foreach($dadosFaturaIndividual as $valor)
                <p>R$ {{ $valor['Valor'] }}</p>
                <hr>
                @endforeach
            </div>
        </div>
    </div>

    <?php // Valor Total ?>
    <div class="col-md-2-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Valor Total</h3>
            </div>
            <div class='box-body'>
                <b style="font-size: 18px;">R$ {{ $valorTotal }}</b>
            </div>
        </div>
    </div>

</body>
</html>
