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
})
