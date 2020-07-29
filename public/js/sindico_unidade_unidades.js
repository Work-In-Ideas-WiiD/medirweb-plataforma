function listarUnidades(bloco) {
    let month = new Date().getMonth() + 1 //mes atual

    $.get(`/sindico/consumo-por-bloco-e-unidade/${bloco}/${month}/${month}`, function(response) {
        let html = '<h3>Bloco '+bloco+'</h3>'

        $.each(response, function(key, value) {
            html += `
            <div class="col-md-3 click-unidade" data-unidade="${key}" data-bloco="${bloco}" data-toggle="modal" data-target=".bd-example-modal-lg">
                <div class="card bg-info" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h3 class="card-title">Unidade ${key}</h3>
                        <p class="card-text">${value[0]}<sup>m3</sup></p>
                    </div>
                </div>
            </div>
            `
        })

        $('.listar-unidades').empty().append(html)
    })
}
