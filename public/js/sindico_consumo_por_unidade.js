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
