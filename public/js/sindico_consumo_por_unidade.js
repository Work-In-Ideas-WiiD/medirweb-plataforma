$(function() {
    consumoDiario()
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

        $.get(`/sindico/consumo-por-bloco-e-unidade/${$('[name=bloco-diario]').val()}/diario`, {
            ano: $('[name=ano-diario]').val(),
            mes: $('[name=mes-diario]').val()
        }, function(response) {
            let html = `
                <tr>
                    <th>Unidade</th>
            `

            $.each(response.dias, function(key, value) {
                html += `<th>${value}</th>`
            })

            html += '</tr>'

            $('.consumo-diario').parent().find('thead').empty().append(html)

            html = ''

            if (response.consumo) {
                $.each(response.consumo, function(key, consumos) {
                    html += `
                        <tr>
                            <td>${key}</td>
                    `

                    $.each(consumos, function(key, value) {
                        html += `<td>${value}</td>`
                    })

                    html += '</tr>'
                })

                $('.consumo-diario').empty().append(html)
            }
        })
    })
}
