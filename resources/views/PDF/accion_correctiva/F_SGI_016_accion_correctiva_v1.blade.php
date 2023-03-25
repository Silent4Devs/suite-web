<!DOCTYPE html>
<html>
<head>
    <title>Accion Correctiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">

        header {
            margin-top: 30px;
        }

        header div {
            float: left;
            height: 70px;
            border-bottom: 1px solid #ccc;
            justify-content: center;
            align-items: center;
        }

        .logo {
            width: 50%;
        }

        .imagen, .info {
            width: 20%;
        }

        .info {
            font-size: 10pt;
            align-content: center;
        }

        .titulo {
            width: 60%;
        }

        header h1 {
            margin: 0;
            padding: 0;
            font-size: 16pt;
            padding-bottom: 50px;
        }

        h2 {
            width: 90%;
            margin-left: 5%;
            margin-top: 50px;
            font-size: 12pt;
            text-align: center;
            float: left;
            text-decoration: underline;
        }

        hr {
            width: 90%;
            margin-left: 5%;
            margin-top: 30px;
            float: left;
            border: none;
            border-bottom: 1px solid #888;
        }

        .borde {
            border: 1px solid #ccc;
        }

        table {
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
        }

        .caja_datos {
            width: 90%;
            margin-left: 5%;
            margin-top: 40px;
        }

        .datos1 table {

        }

        .datos10 table {

        }

        .datos10 th {
            border: 1px solid #ccc;
            font-size: 11pt;
            padding: 10px;
            background-color: #888;
            color: white;
        }

        .datos10 td {
            border: 1px solid #ccc;
        }

        .datos11 .borde {
            width: 600px;
        }

        .datos13 .borde {
            border: none;
            border-bottom: 1px solid #ccc;
            width: 600px;
        }
    </style>

</head>

<body>
<div class="container">
    <header>
        <div class="imagen text-center">
            <img class="logo" src="logo.png">
        </div>
        <div class="titulo text-center">
            <h1>Acción Correctiva</h1>
            <p>{{$datavalues->fecharegistro}}</p>
        </div>
        <div class="info text-center">
            F-SGI-016 V1 <br>
            {{date('j F Y')}}
        </div>
    </header>

    <main>
        <h2>REGISTRO</h2>
        <div class="datos1 caja_datos">
            <table>
                <tr>
                    <td>ID Acción Correctiva:</td>
                    <td class="borde" width="70px">
                        {{$datavalues->id}}
                    </td>
                </tr>
                <tr>
                    <td>Fecha de registro</td>
                    <td class="borde" width="70px">
                        {{$datavalues->fecharegistro}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="datos2 caja_datos">
            <table>
                <tr>
                    <td>Nombre y puesto de quien reportó la acción correctiva:</td>
                    <td class="borde" width="300px">
                        {{$datavalues->nombrereporta_id ." - ". $datavalues->puestoreporta_id}}
                    </td>
                </tr>
                <tr>
                    <td>Nombre y puesto de quien registro la acción correctiva:</td>
                    <td class="borde" width="300px">
                        {{$datavalues->nombreregistra_id ." - ". $datavalues->puestoregistra_id}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="datos3 caja_datos">
            <table>
                <tr>
                    <td>Tema:</td>
                    <td class="borde" width="400px">
                        {{$datavalues->tema}}
                    </td>
                </tr>
            </table>
        </div>

        <hr>

        <div class="datos4 caja_datos">
            <table>
                <h3 style="font-size: 12pt;"> Causa de origen: </h3>
                <tbody>
                <tr>
                    <td>
                        {{$datavalues->causaorigen}}
                    </td>
                    <td class="borde" width="150px"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="datos5 caja_datos">
            <table>
                <tr>
                    <td>Descripción de la desviación o problema real (indicando fechas):</td>
                </tr>
                <tr>
                    <td class="borde" width="600px" height="30px">
                        {{$datavalues->descripcion}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="datos6 caja_datos">
            <table>
                <h3 style="font-size: 12pt;"> Método utilizado para el análisis de causa raíz: </h3>
                <tr>
                    <td>
                        {{$datavalues->metodo_causa}}
                    </td>
                    <td class="borde" width="300px"></td>
                </tr>
            </table>
        </div>
        <div class="datos7 caja_datos">
            <table>
                <tr>
                    <td>Descripción de la Solución:</td>
                </tr>
                <tr>
                    <td class="borde" width="600px" height="30px">
                        {{$datavalues->descripcion}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="datos8 caja_datos">
            <table>
                <tr>
                    <td>Descripción de la validación para el cierre de la acción (para asegurar que las acciones tomadas
                        fueron efectivas)
                    </td>
                </tr>
                <tr>
                    <td class="borde" width="600px" height="30px">
                        {{$datavalues->cierre_accion}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="datos9 caja_datos">
            <table>
                <tr>
                    <td><strong>Estatus:</strong>
                        <br>(por iniciar, en proceso, terminado
                    </td>
                    <td class="borde" width="300px">
                        {{$datavalues->estatus}}
                    </td>
                </tr>
                <tr>
                    <td><strong>Fecha compromiso:</strong></td>
                    <td class="borde" width="300px">
                        {{$datavalues->fecha_compromiso}}
                    </td>
                </tr>
                <tr>
                    <td><strong>Fecha de verificación de la efectividad de la acción correctiva:</strong></td>
                    <td class="borde" width="300px">
                        {{$datavalues->fecha_verificacion}}
                    </td>
                </tr>
            </table>
        </div>


        <h2>PLAN DE ACCIÓN</h2>
        <div class="datos10 caja_datos">
            <table>
                <thead>
                </thead>
                <tr>
                    <th>No.</th>
                    <th>Actividad</th>
                    <th>Responsable</th>
                    <th>Fecha compromiso</th>
                    <th>Estatus (por iniciar, en proceso y terminado)</th>
                </tr>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>


        <h2>LLUVÍA DE IDEAS</h2>

        <div class="datos11 caja_datos">
            <table>
                <tr>
                    <td>1</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td class="borde"></td>
                </tr>
            </table>
        </div>

        <h2>TECNICA 5 POR QUE´S</h2>
        <div class="datos12 caja_datos">
            <table>
                <tr>
                    <td>Descripción del problema, falla o desviación:</td>
                </tr>
                <tr>
                    <td class="borde" width="600px" height="80px"></td>
                </tr>
            </table>
        </div>
        <div class="datos13 caja_datos">
            <table>
                <tr>
                    <td>1.</td>
                    <td>¿Por qué?</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>¿Por qué?</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>¿Por qué?</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>¿Por qué?</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="borde"></td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>¿Por qué?</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="borde"></td>
                </tr>
            </table>
        </div>

        <h2>DIAGRAMA ISHIKAWA</h2>

        <div class="datos14 caja_datos">
            <img src="diagrama.png" width="100%">
        </div>
    </main>
</div>
</body>
</html>
