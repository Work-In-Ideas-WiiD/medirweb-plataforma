$(function() {
    consumoMensal()
    consumoDiario()
})


function consumoMensal() {
    $('#consumo-mensal').submit(function(form) {
        form.preventDefault()

        $.get('/sindico/relatorio/consumo-unidade/mensal', $(this).serialize(), function(response) {
            console.log(response)
        })
    })
}