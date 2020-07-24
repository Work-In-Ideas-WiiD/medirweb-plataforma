$(function() {
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

        $.get('/sindico/relatorio/lista-de-leitura/tabela', $(this).serialize(), function(response) {

            let html = ''

            $.each(response, function(key, value) {
                html += `
                    <tr>
                        <td>${value.created_at}</td>
                        <td>${value.metro}</td>
                        <td>${value.consumo ?? 'sem informação'}</td>
                    </tr>
                `
            })

            $('.leituras').empty().append(html)

        })
    })
})
