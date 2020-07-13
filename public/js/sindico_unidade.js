$(document).ready(function() {
    escolherBloco()
    escolherEComparar()
})


function escolherBloco() {
    $('.escolher-bloco').click(function() {
        let bloco_selecionado = $(this).data('bloco')

        comparativoTabela(bloco_selecionado)
        listarUnidades(bloco_selecionado)

        $.get(`/sindico/unidade/grafico-consumo-anual/${bloco_selecionado}`, function(response) {
            criarGrafico(response['bloco'], response['total'])
        })
    })
}
