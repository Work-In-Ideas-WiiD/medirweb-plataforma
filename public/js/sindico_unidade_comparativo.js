function comparativoTabela(bloco) {
    var tabela = $('.tabela-comparativo-unidades')
    
    var html = ''

    $.get(`/sindico/relatorio/consumo-por-bloco-ultimos6-meses/${bloco}`, function(response) {
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
