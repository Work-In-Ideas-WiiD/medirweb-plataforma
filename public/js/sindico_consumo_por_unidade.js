$(function() {
    consumoDiario()
    consumoMensal()
    $('.loadIcone').css('display','none');

    $('[name=bloco], [name=ano]').change(function() {

        let bloco = $('[name=bloco]').val() != 'bloco'
        let ano = $('[name=ano]').val() != 'ano'

        if (bloco && ano) {
            $('.verificarBotao').prop('disabled', false)
        } else {
            $('.verificarBotao').prop('disabled', true)
        }
    })

    $('[name=bloco-diario], [name=mes-diario], [name=ano-diario]').change(function() {

        let bloco = $('[name=bloco-diario]').val() != 'bloco'
        let ano = $('[name=ano-diario]').val() != 'ano'
        let mes = $('[name=mes-diario]').val() != 'mes'

        if (bloco && ano && mes) {
            $('.aplicar2').prop('disabled', false)
        } else {
            $('.aplicar2').prop('disabled', true)
        }
    })    
})


function consumoMensal() {
    $('#consumo-mensal').submit(function(form) {
        form.preventDefault()
        $('.botaoIr').addClass('disabled');
        $('.botaoIr').attr('type','button');
        $('.loadIcone').css('display','inline-block');

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

            $('.consumo-mensal').empty().append(html);
            $('.botaoIr').removeClass('disabled');
            $('.botaoIr').removeAttr('type');
            $('.loadIcone').css('display','none');
        })
    })
}

function consumoDiario() {
    $('#consumo-diario').submit(function(form) {
        form.preventDefault()
        $('.botaoIr').addClass('disabled');
        $('.botaoIr').attr('type','button');
        $('.loadIcone').css('display','inline-block');

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

                $('.consumo-diario').empty().append(html);
                $('.botaoIr').removeClass('disabled');
                $('.botaoIr').removeAttr('type');
                $('.loadIcone').css('display','none');
            }
        })
    })
}
