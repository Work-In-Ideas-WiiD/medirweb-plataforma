function comparativoTabela(bloco) {
    var tabela = $('.tabela-comparativo-unidades')
    
    var html = ''

    $.get(`/sindico/consumo-por-bloco-e-unidade/${bloco}/0/5`, function(response) {
        tabela.empty()
    
        $.each(response, function(key, value) {

            html += `
                <tr data-unidade="${key}">
                    <td>${key}</td>
            `

            $.each(value, function(mes, consumo) {
                html += `<td data-mes="${mes}" data-consumo="${consumo}" class="mes-para-comparar">${consumo}</td>`
            })

            html += `</tr>`
        })

        tabela.append(html)

    })

}
