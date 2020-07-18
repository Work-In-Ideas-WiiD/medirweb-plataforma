function listarUnidades(bloco) {
    let month = new Date().getMonth() + 1 //mes atual

    $.get(`/sindico/consumo-por-bloco-e-unidade/${bloco}/${month}/${month}`, function(response) {
        let html = ''

        $.each(response, function(key, value) {
            console.log(key, value)
            html += `
            <div class="col-md-3">
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
