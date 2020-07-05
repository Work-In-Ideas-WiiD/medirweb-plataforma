$(function() {
    consumoMensal()

})


function consumoMensal() {
    $('#consumo-mensal').submit(function(form) {
        form.preventDefault()

        $.get(`/sindico/consumo-por-bloco-e-unidade/${$('[name=bloco]').val()}/0/11`, {
            ano: $('[name=ano]').val()
        }, function(response) {
            let html = ''

            $.each(response, function(key, consumos) {
                html += `
                    <tr>
                        <td>${key}</td>
                `

                $.each(consumos, function(key, value) {
                    html += `<td>${value}</td>`
                })

                html += '</tr>'
            })

            $('.consumo-mensal').empty().append(html)
        })
    })
}

function consumoDiario() {
    $('#consumo-diario').submit(function(form) {
        form.preventDefault()

        $.get(`/sindico/consumo-por-bloco-e-unidade/${$('[name=bloco-diario]').val()}/0/11`, {
            ano: $('[name=ano-diario]').val(),
            mes: $('[name=mes-diario]').val()
        }, function(response) {
            let html = ''

            $.each(response, function(key, consumos) {
                html += `
                    <tr>
                        <td>${key}</td>
                `

                $.each(consumos, function(key, value) {
                    html += `<td>${value}</td>`
                })

                html += '</tr>'
            })

            $('.consumo-mensal').empty().append(html)
        })
    })
}
