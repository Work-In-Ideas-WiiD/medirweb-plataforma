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
                    <h4>Olá Boa Noite,</h4>

                    <p>Não foi possível conectar com a central do imóvel "{{$imovel}}", {{$text}}</p>

                    <p>Segue abaixo as informações detalhadas:</p>

                    <p>Imóvel: {{$imovel}}</p>

                    <p>
                        Endereço IP: {{$ip}}<br>
                        Codigo HTTP: {{$codigoHTTP}}<br>

                        @if($codigoHTTP == 200)
                        Status: Servidor está respondendo!
                        @elseif($codigoHTTP == 0)
                        Status: Servidor não está respondendo!
                        @elseif($codigoHTTP == 400)
                        Status: Requisição inválida!
                        @elseif($codigoHTTP == 401)
                        Status: Acesso não autorizado!
                        @elseif($codigoHTTP == 402)
                        Status: Pagamento necessário!
                        @elseif($codigoHTTP == 403)
                        Status: Acesso proibido!
                        @elseif($codigoHTTP == 404)
                        Status: Não encontrado!
                        @elseif($codigoHTTP == 405)
                        Status: Método não permitido!
                        @elseif($codigoHTTP == 406)
                        Status: Não Aceitável!
                        @elseif($codigoHTTP == 407)
                        Status: Autenticação de proxy necessária!
                        @elseif($codigoHTTP == 408)
                        Status: Tempo de requisição esgotou (Timeout)!
                        @elseif($codigoHTTP == 500)
                        Status: Erro interno do servidor! (Internal Server Error)
                        @else
                        Status: Status desconhecido!
                        @endif
                    </p>

                    <p style="color: #848484;">Equipe MedirWeb - Plataforma individualizadora</p><br/>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
