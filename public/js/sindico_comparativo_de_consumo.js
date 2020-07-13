$(function() {
    let mes = [null, 'Jan', 'Fev', 'Març', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']

    $('[name=bloco]').change(function() {
        $.get(`/sindico/relatorio/unidade-por-bloco/${$(this).val()}`, function(response) {

            let html = '<option>unidade</bloco>'

            $.each(response, function(key, value) {
                html += `<option value="${value}">unidade ${value}</option>`
            })

            $('[name=unidade]').empty().append(html)
        })
    })

    $('form').submit(function(form) {
        form.preventDefault()

        $.get('/sindico/relatorio/comparativo-de-consumo-mensal', $(this).serialize(), function(response) {
            let html = `
                <tr>
                    <th>Unidade</th>
            `

            if ($('[name=mes]').val() == 1 | $('[name=mes]').val() == 'mes') {
                for (let i = 1; i <= 6; i++) {
                    html += `<th>${mes[i]}</th>`
                }
            } else {
                for (let i = 7; i <= 12; i++) {
                    html += `<th>${mes[i]}</th>`
                }
            }

            html += '</tr>'

            $('.leituras').parent().find('thead').empty().append(html)

            html = ``

            $.each(response, function(key, consumos) {
                html += `
                    <tr>
                        <td>${key}</td>
                `
                $.each(consumos, function(key, value) {

                    html += `
                        <td>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Inicio</td>
                                        <td>Fim</td>
                                        <td>Consumo</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>${ value.inicio }</td>
                                        <td>${ value.fim }</td>
                                        <td>${ value.consumo }</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    `
                })

                html += '</tr>'

                $('.leituras').empty().append(html)
            })
        })
    })
})
