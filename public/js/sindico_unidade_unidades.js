function listarUnidades(bloco) {
    let month = new Date().getMonth() //mes atual

    $.get(`/sindico/consumo-por-bloco-e-unidade-painel/${bloco}/${month}/${month}`, function(response) {
        let html = '<h3 class="tituloBloco">Bloco '+bloco+'</h3> <div class="listaUnidades">'

        $.each(response, function(key, value) {
            html += `
            <div class="col-md-3 click-unidade" data-unidade="${key}" data-bloco="${bloco}" data-toggle="modal" data-target=".bd-example-modal-lg">
                <div class="card bg-info" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h3 class="card-title">Unidade ${key}</h3>
                        <p class="card-text">${value[0]}m<sup>3</sup></p>
                    </div>
                </div>
            </div>
            `
        })
        html += '</div>'
        $('.listar-unidades').empty().append(html)
    })
}
