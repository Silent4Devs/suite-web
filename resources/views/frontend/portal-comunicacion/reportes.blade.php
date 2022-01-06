@extends('layouts.frontend')
@section('content')
	
	@section('styles')
		<style type="text/css">
			.caja_titulo{
				position: relative;
				width: 100%;
				height: 150px;
			}
			.logo_organizacion_politica{
				height: 150px;
				position: absolute;
				right: 50px;
				bottom: 0;
			}
			.caja_titulo h1{
				position: absolute;
				width: 300px;
				font-weight: bold;
				color: #00abb2;
				bottom: 0;
			}



        .caja_titulo h1 {
            position: absolute;
            width: 300px;
            font-weight: bold;
            color: #345183;
            bottom: 0;
        }



        .cards_reportes {
            width: 250px;
            padding: 20px 0px;
            padding-left: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
            display: inline-block;
            margin: 10px;
            cursor: pointer;
            color: #888888;
        }

        .cards_reportes i {
            font-size: 16pt;
            margin-right: 10px;
        }

        .cards_reportes:hover {
            color: #345183;
            border: 1px solid #345183;
        }

    </style>
@endsection