<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/requisiciones.css') }}{{config('app.cssVersion')}}">
    <title>Error</title>
</head>
<body>
    <div class="card card-content caja-blue">

        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="width: 150px;">
        </div>

        <div>
            <h3 style="font-size: 22px; font-weight: bolder;">Las causas por las que no puedes agregar el siguiente registro  es la siguiente</h3>
            <ul>
                <li>La clave de registro  ya esta siendo utilizada  regresa y asignale otra</li>
            </ul>
            <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="color: whitesmoke" class="btn_cancelar">Regresar</a>
        </div>
    </div>

</body>
</html>
