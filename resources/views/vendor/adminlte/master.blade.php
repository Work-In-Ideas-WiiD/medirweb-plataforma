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
           IMO_IDESTADO: jQuery('#imo_idestado').val(),
           IMO_IDCIDADE: jQuery('#imo_idcidade').val()
        },
        success: function(result){
           //jQuery('.alert').show();
           //jQuery('.alert').html(result.success);
           var $html = '';
           $('#resultadoPesquisa').html($html);

            $.each(result.imoveis, function () {
                var $html  = '<div class="col-md-3 agrupamento imolista">';
                    $html += '<a href="{!! url('imovel/ver/') !!}/' + this.IMO_ID + '" alt=\'"' + this.IMO_NOME + '"\' >' ;
                    $html += '<div class="bloco-agrupamento-vis">';
                    $html +=    '<i class="fa fa-building"></i>';
                    $html +=    '<p class="imo">' + this.IMO_NOME + '</p>';
                    $html +=    '<p class="imo imobairro">' + this.IMO_BAIRRO + '</p>';
                    $html += '</div>';
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
