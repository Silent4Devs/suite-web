<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/requisiciones.css') }}">
    <title>Error</title>
</head>
<body>
    <div class="card card-content caja-blue">

        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="width: 150px;">
        </div>

        <div>
            <h3 style="font-size: 22px; font-weight: bolder;">Las causas por las que no puedes acceder a la siguiente requisición son las siguientes </h3>
            <ul>
                <li>El registros  ha sido eliminado</li>
                <li>Tu conexión de internet es inestable</li>
            </ul>
        </div>
    </div>

</body>
</html>
