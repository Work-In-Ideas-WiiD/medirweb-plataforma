<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    @endif

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables with bootstrap 3 style -->
        <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
    @endif

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/jquery-inputmask/dist/jquery.inputmask.bundle.js') }}"></script>

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables with bootstrap 3 renderer -->
    <script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
@endif

@if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
@endif

<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="UNI_IDIMOVEL"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    //url: '/medirweb/public/imovel/getCidadesLista/'+stateID,
                    url: '/unidade/getAgrupamentoLista/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="UNI_IDAGRUPAMENTO"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="UNI_IDAGRUPAMENTO"]').append('<option value="'+ value.AGR_ID +'">'+ value.AGR_NOME +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="PRU_IDIMOVEL"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    //url: '/medirweb/public/imovel/getCidadesLista/'+stateID,
                    url: '/equipamento/getAgrupamentoLista/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="PRU_IDAGRUPAMENTO"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="PRU_IDAGRUPAMENTO"]').append('<option value="'+ value.AGR_ID +'">'+ value.AGR_NOME +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="PRU_IDAGRUPAMENTO"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    //url: '/medirweb/public/imovel/getCidadesLista/'+stateID,
                    url: '/equipamento/getUnidadeLista/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="PRU_IDUNIDADE"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="PRU_IDUNIDADE"]').append('<option value="'+ value.UNI_ID +'">'+ value.UNI_NOME +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="IMO_IDESTADO"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    //url: '/medirweb/public/imovel/getCidadesLista/'+stateID,
                    url: '/imovel/getCidadesLista/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="IMO_IDCIDADE"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="IMO_IDCIDADE"]').append('<option value="'+ value.CID_ID +'">'+ value.CID_NOME +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });

    $(document).ready(function() {
        $('select[name="CLI_ESTADO"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    //url: '/medirweb/public/imovel/getCidadesLista/'+stateID,
                    url: '/imovel/getCidadesLista/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="CLI_CIDADE"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="CLI_CIDADE"]').append('<option value="'+ value.CID_ID +'">'+ value.CID_NOME +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>

<script type="text/javascript">

    function previewUploadFoto(input, img) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(img).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewUploadCapa(input, img) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.imagem').css('background','url("'+e.target.result+'")');
                //$('.imagem').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $( ".nome" )
        .change(function () {
            var str = $( this ).val();
            $( ".labelNome" ).text( str );
        })
        .change();

    $( ".bairro" )
        .change(function () {
            var str = $( this ).val();
            $( ".labelBairro" ).text( str );
        })
        .change();

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        if($.fn.datepicker) {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                autoclose: true,
            });
        }

        if($.fn.inputmask) {
            $('.mask-date').inputmask('99/99/9999');
            $('.mask-hour').inputmask('99:99');
            $('.mask-cpf').inputmask('999.999.999-99');
            $('.mask-cnpj').inputmask('99.999.999/9999-99');
            $('.mask-ano').inputmask('9999');
            $('.mask-cep').inputmask('99999999');
            $('.mask-num').inputmask('9[99999]');
            $('.mask-phone').inputmask('(99) 9999-9999[9]');
            $('.mask-co').inputmask('Regex', {regex: "[a-zA-Z- ]*"});
        }

        if($.fn.maskMoney) {
            $('.mask-money').maskMoney()
        }

        $('#participou').on('change', function () {
            if($(this).val() == '1')
            {
                $('.selectblock').show();
            }
            else{
                $('.selectblock').fadeOut('fast');
            }
        })

    });

</script>


<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="CLI_TIPO"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID == 1) {
                $('.cnpj').fadeOut();
                $('.cpf').fadeIn();
                $('.classcpf').attr('required', 'required');
                $('.classcnpj').removeAttr('required');
            }
            if(stateID == 2) {
                $('.cpf').fadeOut();
                $('.cnpj').fadeIn();
                $('.classcnpj').attr('required', 'required');
                $('.classcpf').removeAttr('required');
            }
        });
    });

</script>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#submitFiltro').click(function(e){
    //alert(jQuery('#imo_idestado').val());
    //alert(jQuery('#imo_idcidade').val());

     e.preventDefault();
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
     jQuery.ajax({
        url: "{!! url('/imovel/getImoveisLista') !!}",
        method: 'post',
        data: {
           IMO_IDESTADO: jQuery('#IMO_IDESTADO').val(),
           IMO_IDCIDADE: jQuery('#IMO_IDCIDADE').val()
        },
        success: function(result){

            if(result.imoveis.length < 1)
            {
                $('#resultadoPesquisa').html('');
                $('#resultadoPesquisa').append('<p style="text-align: center;">Sem resultados para mostrar</p>');
                return;
            }

           //jQuery('.alert').show();
           //jQuery('.alert').html(result.success);

           var $html = '';
           $('#resultadoPesquisa').html($html);

            $.each(result.imoveis, function () {
                /*var $html  = '<div class="col-md-3 agrupamento imolista">';
                    $html += '<a href="{!! url('imovel/ver/') !!}/' + this.IMO_ID + '" alt=\'"' + this.IMO_NOME + '"\' >' ;
                    $html += '<div class="bloco-agrupamento-vis">';
                    $html +=    '<i class="fa fa-building"></i>';
                    $html +=    '<p class="imo">' + this.IMO_NOME + '</p>';
                    $html +=    '<p class="imo imobairro">' + this.IMO_BAIRRO + '</p>';
                    $html += '</div>';
                    $html += '</a>';
                    $html += '</div>';*/


                var $html  = '<div class="col-md-4">';
                    $html += '<a href="{!! url('imovel/buscar/ver/') !!}/' + this.IMO_ID + '" alt="' + this.IMO_NOME + '" style="text-decoration: none; color: #111;" >';
                    $html +=    '<div class="box box-widget widget-user">';
                    if(this.IMO_CAPA == null)
                    {
                        $html +=        '<div class="widget-user-header bg-black" style="background: url(\'http://www.condominiosc.com.br/media/k2/items/cache/2a7c5a55d24475c5674a6cabf9d5e3d4_XL.jpg\') center center;">';

                    }
                    else
                    {
                        $html +=        '<div class="widget-user-header bg-black" style="background: url(\'http://localhost/medirweb/public/upload/capas/' + this.IMO_CAPA +'\') center center;">';
                    }
                    $html +=            '<h3 class="widget-user-username">' + this.IMO_NOME + '</h3>';
                    $html +=            '<h5 class="widget-user-desc">' + this.IMO_BAIRRO + '</h5>';
                    $html +=        '</div>';
                    $html +=        '<div class="widget-user-image">';
                if(this.IMO_FOTO == null)
                {
                    $html +=   '<img class="img-circle" src="http://i63.tinypic.com/nex65y.png" alt="User Avatar">';
                }
                else
                {
                    $html +=    '<img class="img-circle" src="http://localhost/medirweb/public/upload/fotos/'+this.IMO_FOTO+'" alt="User Avatar">';
                }
                    // $html +=        '<img class="img-circle" src="http://i63.tinypic.com/nex65y.png" alt="User Avatar">';
                    $html +=        '</div>';
                    $html +=        '<div class="box-footer">';
                    $html +=            '<div class="row">';
                    $html +=                '<div class="col-sm-4 border-right">';
                    $html +=                    '<div class="description-block">';
                    $html +=                        '<h5 class="description-header">' + this.AGR + '</h5>';
                    $html +=                        '<span class="description-text">Agrupamentos</span>';
                    $html +=                    '</div>';
                    $html +=                '</div>';
                    $html +=                '<div class="col-sm-4 border-right">';
                    $html +=                    '<div class="description-block">';
                    $html +=                        '<h5 class="description-header">' + this.UNI + '</h5>';
                    $html +=                        '<span class="description-text">Unidades</span>'
                    $html +=                    '</div>';
                    $html +=                '</div>';
                    $html +=                '<div class="col-sm-4">';
                    $html +=                    '<div class="description-block">';
                    $html +=                        '<h5 class="description-header">0</h5>';
                    $html +=                        '<span class="description-text">Equipamentos</span>';
                    $html +=                    '</div>';
                    $html +=                '</div>';
                    $html +=            '</div>';
                    $html +=        '</div>';
                    $html +=    '</div>';
                    $html += '</a>';
                    $html += '</div>';


                    $('#resultadoPesquisa').append($html);
            });
        },
     });
  });
});
</script>

<script>
    $(document).ready(function(){
        $('#tabelaPrincipal').DataTable({
            "order": [[ 0, "desc" ]],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });

        $('.powertabela').DataTable({
            "order": [[ 0, "asc" ]],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
</script>

<script>
var ctx = document.getElementById("grafico");

var vlabels = Array();
$("#tabelaPrincipal tr td:nth-child(3)").each(function(i, v){
        vlabels[i] = $(this).text();
})
console.debug(vlabels);

var dPontos = Array();
$("#tabelaPrincipal tr td:nth-child(4)").each(function(i, v){
        dPontos[i] = $(this).text();
})
console.debug(dPontos);


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: dPontos.reverse(),
        datasets: [{
            label: 'Consumo nos últimos 5 dias',
            data: vlabels.reverse(),
            backgroundColor: [
                'rgba(0,154,191,0.2)'
            ],
            borderColor: [
                'rgba(0,192,239,1)'
            ]
        },
        {
            label: 'Consumo na mesma data, no mês anterior',
            data: [0, 80, 90, 110, 221],
            backgroundColor: [
                'rgba(238,95,53,0.2)'
            ],
            borderColor: [
                'rgba(238,95,53,1)'
            ]
        }]
    }
});
</script>

@yield('adminlte_js')

</body>
</html>
