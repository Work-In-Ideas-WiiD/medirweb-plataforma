$(document).ready(function() {
    escolherBloco()
    escolherEComparar()
    $('body > div > div > section.content > div:nth-child(5) > div.col-md-2.containerBloco > p:nth-child(1) > a').trigger('click');
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });


    $('body').on('click', '.mes-para-comparar', function() {

        $('.expComp').fadeOut();
        $('#unidade-e-mes0').show();
        $('#unidade-e-mes1').show();
        $('#diferenca-consumo').css("display", "flex");
        $('#diferenca-porcentagem').css("display", "flex");
        $('#consumo0').show();
        $('#consumo1').show();

    });

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
