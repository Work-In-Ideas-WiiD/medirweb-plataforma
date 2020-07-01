$(document).ready(function() {
    escolherBloco()
})


function escolherBloco() {
    $('.escolher-bloco').click(function() {
        let bloco_selecionado = $(this).data('bloco')

        comparativoTabela(bloco_selecionado)
    })
}
