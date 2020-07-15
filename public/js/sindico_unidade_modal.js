$(function() {
    $(document).on('click', '.click-unidade', function() {
        let bloco = $(this).data('bloco')
        let unidade = $(this).data('unidade')

        $.get('/sindico/unidade/dados', {unidade, bloco}, function(response) {
            $('.modal-unidade-nome').text(response.nome_responsavel)
            $('.modal-unidade-cpf').text(`CPF ${response.cpf_responsavel}`)
            $('.modal-unidade-bloco').html(`Unidade ${ unidade } <br>Bloco ${ bloco }`)
        })

        $.get(`/sindico/unidade/modal-grafico/${bloco}/${unidade}`, function(response) {
            let data = []

            $.each(response, function(key, value) {
                data.push(value)
            })

            modalGrafico(data)
        })
    })
})
