jQuery(document).ready(function(){
  jQuery('#submitFiltro').click(function(e){
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
           name: jQuery('#id_estado').val(),
           type: jQuery('#id_cidade').val(),
        },
        success: function(result){
           jQuery('.alert').show();
           jQuery('.alert').html(result.success);
           alert(result.success);
        }});
     });
  });