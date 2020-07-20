$(function() {
    let comparar = [
        {consumo: null, mes: null, ultimo: false},
        {consumo: null, mes: null, ultimo: false},
    ]

    $('body').on('click', '.mes-para-comparar', function() {

        if (!comparar[0].ultimo) {
            comparar[0].consumo = $(this).data('consumo')
            comparar[0].mes = $(this).data('mes')
            comparar[0].ultimo = true
            comparar[1].ultimo = false
        } else {
            comparar[1].consumo = $(this).data('consumo')
            comparar[1].mes = $(this).data('mes')
            comparar[1].ultimo = true
            comparar[0].ultimo = false
        }

        console.log(comparar)

        $('#unidade-e-mes0').text(`${comparar[0].mes}`)
        $('#consumo0').html(`${comparar[0].consumo}<sup>m3</sup>`)

        if (comparar[1].mes) {
            $('#unidade-e-mes1').text(`${comparar[1].mes}`)
            $('#consumo1').html(`${comparar[1].consumo}<sup>m3</sup>`)

            // se quiser inverter os sinais que aparece no "circulo" 1 e dois do comparativo, pasta inverter o indice 1 para 0 e 0 para 1
            diferenca_consumo = comparar[1].consumo - comparar[0].consumo

            diferenca_porcentagem = ((comparar[1].consumo / comparar[0].consumo) * 100).toFixed(2)

            if (diferenca_consumo > 0) {
                $('#diferenca-consumo').text(`+${diferenca_consumo}`)
                $('#diferenca-porcentagem').text(`+${diferenca_porcentagem}%`)
            } else if(diferenca_consumo == 0) {
                $('#diferenca-consumo').text(diferenca_consumo)
                $('#diferenca-porcentagem').text(`${diferenca_porcentagem}%`)
            } else {
                $('#diferenca-consumo').text(`${diferenca_consumo}`)
                $('#diferenca-porcentagem').text(`${diferenca_porcentagem}%`)
            }
        }

    })
})
