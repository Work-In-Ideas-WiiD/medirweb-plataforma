<html>
<head>
    <title>medirweb.com.br - MedirWeb - Plataforma individualizadora</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#eb008b">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

    <style>
    #botao{
        display: inline-block;
        margin: 0;
        width: 100%;
        text-align: center;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    #botao a{
        background: #3c8dbc;
        color: #ffffff !important;
        text-decoration: none;
        padding: 15px;
        padding-left: 60px;
        padding-right: 60px;
        width: 50%;
        font-size: 18px;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 3px 0 #367fa9;
        border-radius: 5px;
    }
    #botao:hover a{
        background: #ffffff;
        color: #3c8dbc !important;
        border: 1px solid #3c8dbc;
        box-shadow: none;
    }

    </style>

</head>
<body style="width: 600px; margin: 0 auto; font-family: 'Open Sans', sans-serif; background: #f8f8f8;">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; position: relative; z-index: 2; background: #FFFFFF; ">
        <tr>
            <td id="conteudo" style="border: 0px 1px 1px 1px solid #DDDDDD; display: block; position: relative; z-index: 2; padding: 0 0.8em;">
                <div style="position: relative; z-index: 9;">
                    <h4>Olá {{$nome}},</h4>

                    <p>Obrigado, seu usuário foi criado com sucesso na nossa Plataforma MedirWeb.</p>

                    <p>Sua senha para acesso ao aplicativo MedirWeb é: {{$senha}}</p>

                    <p>Baixe o app gratis! Disponível para iPhone e Android.</p>

                    <p style="color: #848484;">Muito obrigado!<br/>Equipe MedirWeb - Plataforma individualizadora</p><br/>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
