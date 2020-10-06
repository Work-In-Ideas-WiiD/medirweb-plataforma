$(function() {
    $('[type=search]').autocomplete({
        source: function(request, response) {
            var bloco = $('#__BLOCO__').val()

            if (bloco) {
                var url = `/sindico/busca?termos=__BLOCO__${bloco},${$('[type=search]').val()}`
            } else {
                var url = `/sindico/busca?termos=${$('[type=search]').val()}`
            }

            $.get(url, function(res) {
                response($.map( res, function( item ) {
                    let content = `${item.agrupamento.nome} - ${item.nome} | ${item.nome_responsavel}`
                    return {
                        data: item,
                        label: content,
                        value: content,
                    }
                  })
                );
            })
        },
        select: function( event, ui ) {
            let data = ui.item.data

            window.location.href = `/sindico/unidade/comparativo-de-consumo/${data.agrupamento.nome}/${data.nome}`
        },
        minLength: 2
    })
})