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

        $.get('/sindico/relatorio/comparativo-de-consumo-mensal', $(this).serialize(), function(response) {
            console.log(response)
        })
    })
})
