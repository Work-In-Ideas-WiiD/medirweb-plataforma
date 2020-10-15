function listarUnidades(bloco) {
    let month = new Date().getMonth() //mes atual

    $.get(`/sindico/consumo-por-bloco-e-unidade-painel/${bloco}/${month}/${month}`, function(response) {
        // let html = '<h3 class="tituloBloco">'+bloco+'</h3> <div class="listaUnidades">'
        let html = '<h3 class="tituloBloco">Aldeia do Vale - '+bloco+'</h3> <div class="listaUnidades">'
// data-target=".bd-example-modal-lg"
        $.each(response, function(key, value) {
            html += `
            <a class="click-unidade" href="/sindico/unidade/comparativo-de-consumo/${bloco}/${key}" data-unidade="${key}" data-bloco="${bloco}" data-toggle="modal" >
                <div class="card bg-info" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h3 class="card-title">Unidade ${key}</h3>
                        <p class="card-text">${value[0]}m<sup>3</sup></p>
                    </div>
                </div>
            </a>
            `
        })
        html += '</div>'
        $('.listar-unidades').empty().append(html)
    })
}
