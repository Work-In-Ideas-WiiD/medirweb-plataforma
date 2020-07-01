$(document).ready(function() {
    escolherBloco()
    escolherEComparar()
})


function escolherBloco() {
    $('.escolher-bloco').click(function() {
        let bloco_selecionado = $(this).data('bloco')

        comparativoTabela(bloco_selecionado)
    })
}
