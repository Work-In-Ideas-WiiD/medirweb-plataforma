$(function() {
    $(document).on('click', '.click-unidade', function() {
        let bloco = $(this).data('bloco')
        let unidade = $(this).data('unidade')

        $('#link-comparativo-consumo').attr('href', `/sindico/unidade/comparativo-de-consumo/${bloco}/${unidade}`)

        $.get('/sindico/unidade/dados', {unidade, bloco}, function(response) {
            $('.modal-unidade-nome').text(response.nome_responsavel)
            $('.modal-unidade-cpf').text(`CPF ${response.cpf_responsavel}`)
            //$('.modal-unidade-bloco').html(`Unidade ${ unidade } <br>Bloco ${ bloco }`)
        })

        $.get(`/sindico/unidade/modal-grafico/${bloco}/${unidade}`, function(response) {
            let data = []

            $.each(response, function(key, value) {
                data.push(value)
            })

            modalGrafico(data)
        })

        $.get(`/sindico/unidade/modal-media-anual/${bloco}/${unidade}`, function(response) {
            $('.modal-media-anual').find('div').text(response+"m³")
            $('.modal-media-mensal').find('div').text(parseInt(response / 12)+"m³")
        })

        $.get(`/sindico/unidade/modal-este-mes/${bloco}/${unidade}`, function(response) {
            $('.modal-este-mes').find('div').text(response+"m³")
        })
    });
    $(document).on('click', ".iconeFechar", function(){
        $(".bd-example-modal-lg").trigger('click');
    });
})
