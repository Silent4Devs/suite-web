<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(232, 234, 239);
            font-family: Helvetica;
            text-align: center;
        }

        img {
            width: 90%;
            margin-bottom: 35px;
        }

        p {
            color: #747474;
        }

        .card-error {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            width: 350px;
            height: 500px;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #6e749e;
            color: #fff;
            margin: auto;
            padding: 10px 30px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 35px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="card-error">

        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt="Apoyo">
        </div>

        <div>
            <h3 style="font-size: 22px; font-weight: bolder; color: #474c6c;">
                Acceso restringido
            </h3>
            <p style="margin-top: 35px;">
                No tienes permisos para firmar en este momento
            </p>
            <a href="{{ route('contract_manager.requisiciones.indexAprobadores') }}" class="btn">Regresar</a>
        </div>
    </div>

</body>

</html>

<script>
     @if(session('mensaje'))
    <script>
        alert("{{ session('mensaje') }}");
    </script>
    @endif
</script>
