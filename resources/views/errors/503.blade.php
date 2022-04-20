<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NOT FOUND</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj_v2.png') }}">
    <style>
        body {
            margin: 0;
            /* la imagen a ser mostrada a pantalla completa */
            background: url("{{ asset('img/errors/503.svg') }}") no-repeat center center fixed;

            /* nos aseguramos que el elemento ocupe toda la ventana del navegador */
            min-height: 100%;

            /* Propiedad a utilizar para la imagen */
            background-size: cover;
        }

        .btn {
            border: 1px solid #345183;
            display: inline-block;
            padding: 15px 15px;
            border-radius: 5px;
            color: #345183;
            margin-bottom: 60px;
            text-decoration: none;
            transition: all 0.3s ease 0s;
        }

        .btn:hover {
            transition: 0.5s;
            background-color: #345183;
            color: white;
        }

    </style>
</head>

<body>
    <div style="width: 100%;height: 100vh;display: flex;justify-content: center;align-items: end;">
        <div>
            <a href="/admin/inicioUsuario#datos" class="btn">Regresar</a>
        </div>
    </div>
</body>

</html>
