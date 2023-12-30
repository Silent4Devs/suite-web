<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Análisis de Brechas</title>
</head>

<body>
    <div class="card col-sm-12 col-md-10" style="border-radius: 16px; box-shadow: none; border-color:white; width: auto;">
        <div class="card-body" style="">
            <div class="card mt-5" style="width:900px;box-shadow:4px;">
                <div class="row col-12 ml-0"
                    style="border-radius;
                                            padding-left: 0px;padding-right: 0px;">
                    <div class="col-3" style="border-left: 25px solid #2395AA">
                        <img src="{{ asset('silent.png') }}" class="mt-2 img-fluid"
                            style=" width:60%; position: relative; left: 1rem; top: 1.5rem;">
                    </div>
                    <div class="col-5 p-2 mt-3">
                        <br>
                        <span class="" style="color:black; position: relative; top: -1.5rem; right: 3rem;">
                            {{ $empresa_actual }} <br>
                            RFC: {{ $rfc }} <br>
                            {{ $direccion }} <br>
                        </span>

                    </div>
                    <div class="col-4 pt-6 pl-6" style="background:#FFFFFF;">
                        <br>
                        <br>
                        <br>
                        <span class="textopdf"> <strong> Reporte Análisis de Brechas</strong></span>
                    </div>
                    <br>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
