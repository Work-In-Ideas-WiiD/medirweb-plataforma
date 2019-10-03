<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    <!-- Chosen -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/chosen/chosen.css') }}">

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

    <!-- Chosen -->
    <script src="{{ asset('vendor/adminlte/vendor/chosen/chosen.jquery.js') }}"></script>

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
    //UNIDADES - CAMPO AGRUPAMENTO
    $(document).ready(function() {

        $('select[name="imovel_id"]').on('change', function() {

            $.get(`/imovel/${$(this).val()}/agrupamento`, function(data) {
                    
                $('select[name="agrupamento_id"]').empty();
                    
                $.each(data, function(key, value)  {                          
                    $('select[name="agrupamento_id"]').append(`<option value="${key}">${value}</option>`)
                })
               
            });


            $.get(`/imovel/${$(this).val()}/unidade`, function(data) {
                $('select[name="unidade_id"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="unidade_id"]').append(`<option value="${key}">${value}</option>`)
                })
            })
            
        });


        $('select[name="agrupamento_id"]').on('change', function() {

            $.get(`/agrupamento/unidade/${$(this).val()}`, function(data) {
                $('select[name="unidade_id"]').empty();
                    
                $.each(data, function(key, value)  {
                    $('select[name="unidade_id"]').append(`<option value="${key}">${value}</option>`);
                })                   
            
            });
        });
    });
 
      

    $(document).ready(function() {
        $('select[name="PRU_IDUNIDADE"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    //url: '/medirweb/public/imovel/getCidadesLista/'+stateID,
                    url: '/timeline/equipamento/getEquipamentoLista/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="TIMELINE_IDPRUMADA"]').empty();
                        $('select[name="TIMELINE_IDPRUMADA"]').append('<option>Selecione Equipamento</option>');
                        $.each(data, function(key, value) {
                            $('select[name="TIMELINE_IDPRUMADA"]').append('<option value="'+ value.PRU_ID +'">'+ '#' + value.PRU_ID + ' - ' + value.PRU_FABRICANTE + ' ' + value.PRU_MODELO +'</option>');
                        });

                        $('select[name="TIMELINE_IDPRUMADA"]').trigger('chosen:updated');
                        $(".chosen-select-TIMELINE_IDPRUMADA").chosen({no_results_text: "Oops, nada encontrado!"});

                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
    </script>

    <script type="text/javascript">
    // LOADING

    function loading() {
        $('.loading').slideDown();
        $('.ocultar').addClass('disabled');
    }
    </script>

    <script>
    // Por Favor aguarde
    var ponto = 'Por favor, aguarde.';
    var timeout = false;
    var velocidade = 2000;
    function animaPonto() {
      /*  timeout = setTimeout('animaPonto()', velocidade);
        document.getElementById('aguarde').innerHTML = ponto;
        if( ponto == 'Por favor, aguarde...' ) {
            ponto = 'Por favor, aguarde.';
        } else {
            ponto += '.';
        }
        */
    }
    animaPonto();
   
    $(document).ready(function() {

        $('select[name="estado_id"]').on('change', (data) => {

            $.ajax({
                url: '/cidades/'+data.target.value,
                type: "GET",
                dataType: "json",
                success:function(data) {

                    $('select[name="cidade_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="cidade_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });

                    $('select[name="cidade_id"]').trigger('chosen:updated');                   

                }
            });

        });

    });


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
            $('.mask-ano').inputmask('9999');
            $('.mask-co').inputmask('Regex', {regex: "[a-zA-Z- ]*"});
            $('.mask-inteiro').inputmask('Regex', {regex: "[0-9]*"});

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


    <script>
    $(document).ready(function(){
        $(".mask-dinheiro").inputmask( 'currency',{"autoUnmask": true,
        radixPoint:",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: '',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: true
    })});


    $(document).ready(function() {
        $('input[name="ip"]').inputmask('[9][9][9].[9][9][9].[9][9][9].[9][9][9]')
        $('input[name="cep"]').inputmask('99999-999')
        $('input[name="cnpj"]').inputmask('99.999.999/9999-99')
        $('input[name="cpf"]').inputmask('999.999.999-99')
        $('input[name="telefone"]').inputmask('(99) 9999-9999[9]')
        $('input[name="numero"]').inputmask('9[99999]')

        function tipoDocumento(tipo) {
            if(tipo == 1)
                $('input[name="documento"]').inputmask('999.999.999-99')
            else
                $('input[name="documento"]').inputmask('99.999.999/9999-99')
        }

        tipoDocumento(
            $('select[name="tipo"]').val()
        )

        $('select[name="tipo"]').on('change', function() {
            tipoDocumento($(this).val())
        });
    });

    //BUSCAR IMOVEL

    $(document).ready(function(){
        $('#submitFiltro').click(function(e){
           
            $.ajax({
                url: '/imovel/lista/'+$('select[name="cidade_id"]').val(),
                method: 'get',
                success: function(data){

                    if(data.length < 1) {
                        $('#resultadoPesquisa').html('');
                        $('#resultadoPesquisa').append('<p style="text-align: center;">Sem resultados para mostrar</p>');
                        return;
                    }

                    var $html = '';
                    $('#resultadoPesquisa').html($html);

                    $.each(data, function () {

                        var $html  = '<div class="col-md-4">';
                        $html += '<a onclick="loading()" href="{!! url('imovel/buscar/ver/') !!}/' + this.id + '" alt="' + this.nome + '" style="text-decoration: none; color: #111;" >';
                        $html +=    '<div class="box box-widget widget-user">';
                        if(!this.capa) {
                            $html += '<div class="widget-user-header bg-black" style="background: url(\'http://www.condominiosc.com.br/media/k2/items/cache/2a7c5a55d24475c5674a6cabf9d5e3d4_XL.jpg\') center center;">';

                        } else {
                            $html += `<div class="widget-user-header bg-black" style="background: url('/upload/capas/${this.capa}') center center;">`;
                        }
                        $html += `<h3 class="widget-user-username">${this.nome}</h3>;
                                    <h5 class="widget-user-desc">${this.bairro}</h5>
                                </div>
                            <div class="widget-user-image">`;
                        if(!this.foto) {
                            $html += `<img class="img-circle" src="https://via.placeholder.com/100" alt="User Avatar">`;
                        } else {
                            $html += `<img class="img-circle" src="/upload/fotos/${this.foto}" alt="User Avatar">`;
                        }

                        $html += `</div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">${this.agrupamentos}</h5>
                                                    <span class="description-text">Agrupamentos</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">${this.unidades}</h5>
                                                    <span class="description-text">Unidades</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">${this.prumadas}</h5>
                                                    <span class="description-text">Prumadas</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>`


                        $('#resultadoPesquisa').append($html);
                    });
                },
            });
        });
    });

    //BUSCAR TIMELINE Equipamento

    jQuery(document).ready(function(){
        jQuery('#submitFiltroTimeline').click(function(e){

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{!! url('/timeline/equipamento/getTimelineLista') !!}",
                method: 'post',
                data: {
                    TIMELINE_IDPRUMADA: jQuery('#TIMELINE_IDPRUMADA').val()
                },
                success: function(result){

                    if(result.timelines.length < 1)
                    {
                        $('#resultadoPesquisaTIMELINE').html('');
                        $('#resultadoPesquisaTIMELINE').append('<p style="text-align: center;">Sem resultados para mostrar</p>');
                        return;
                    }

                    var $html = '';
                    $('#resultadoPesquisaTIMELINE').html($html);

                    $.each(result.timelines, function () {

                        var $html  = '<ul class="timeline">';

                        $html +=     '<li class="time-label">';
                        $html +=         '<span class="bg-yellow">';
                        $html +=             this.data;
                        $html +=          '</span>';
                        $html +=      '</li>';

                        $html +=       '<li>';
                        $html +=           '<i class="'+ this.TIMELINE_ICON +'"></i>';
                        $html +=            '<div class="timeline-item">';
                        $html +=                '<span class="time"><i class="fa fa-clock-o"></i>' + this.hora + '</span>';
                        $html +=                '<h3 class="timeline-header"><a href="#">' + this.TIMELINE_USER + '</a> ' + this.TIMELINE_DESCRICAO + '</h3>';
                        $html +=            '</div>';
                        $html +=        '</li>';

                        $html += '</ul>';

                        $('#resultadoPesquisaTIMELINE').append($html);
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

        $('.powertabelaDesc').DataTable({
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
