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
                response( $.map( res, function( item ) {
                    return {
                        item: item,
                        label: `${item.nome} / ${item.nome_responsavel}`,
                        value: item.id
                    }
                  }));
            })
        },
        minLength: 2
    })
})