$(function() {
    $('.loadIcone').css('display','none');
    $('[name=bloco]').change(function() {
        $.get(`/sindico/relatorio/unidade-por-bloco/${$(this).val()}`, function(response) {

            let html = '<option>unidade</bloco>'

            $.each(response, function(key, value) {
                html += `<option value="${value}">unidade ${value}</option>`
            })

            $('[name=unidade]').empty().append(html)
        })
    })

    $('form').submit(function(form) {
        form.preventDefault()
        $('.botaoIr').addClass('disabled');
        $('.botaoIr').attr('type','button');
        $('.loadIcone').css('display','inline-block');

        $.get('/sindico/relatorio/lista-de-leitura/tabela', $(this).serialize(), function(response) {

            let html = ''

            $.each(response, function(key, value) {
                html += `
                    <tr>
                        <td>${value.created_at}</td>
                        <td>${value.metro}</td>
                        <td>${value.consumo!=null?value.consumo:'sem informação'}</td>
                    </tr>
                `
            })

            $('.leituras').empty().append(html);
            $('.botaoIr').removeClass('disabled');
            $('.botaoIr').removeAttr('type');
            $('.loadIcone').css('display','none');

        })
    })


    $('[name=bloco], [name=unidade], [name=data_inicio], [name=data_fim]').change(function() {
        let bloco = $('[name=bloco]').val() != 'bloco'
        let unidade = $('[name=unidade]').val() != 'unidade'
        let data_inicio = $('[name=data_inicio]').val() != ''
        let data_fim = $('[name=data_fim]').val() != ''

        if (bloco && unidade && data_inicio && data_fim) {
            $('.botaoIr').prop('disabled', false)
        } else {
            $('.botaoIr').prop('disabled', true)
        }
    })
})
