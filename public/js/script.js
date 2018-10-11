jQuery(document).ready(function() {
    jQuery('#submitFiltro').click(function (e) {
        e.preventDefault();

        alert('vai');

        /*$.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
       });
        jQuery.ajax({
           url: "{!! url('/imovel/getImoveisLista') !!}",
           method: 'post',
           data: {
              name: jQuery('#IMO_IDESTADO').val(),
              name: jQuery('#IMO_IDCIDADE').val(),
           },
           success: function(result){
              jQuery('.alert').show();
              jQuery('.alert').html(result.success);
              alert(result.success);
           }});
        });*/
    })
});