function comparativoTabela(bloco) {
    var tabela = $('.tabela-comparativo-unidades')
    
    var html = ''

    let month = new Date().getMonth()

    let diferenca = (month - 6) + 1

    $.get(`/sindico/consumo-por-bloco-e-unidade/${bloco}/${diferenca}/${month}`, function(response) {
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
