<div class="mt-3 col-sm-12 form-group px-0">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500&display=swap" rel="stylesheet"> --}}
    {{-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> --}}

    <style>
        /* table {
            font-family: 'Poppins', sans-serif;
        } */
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }

        label input.form-control {
            border: none;
            border-bottom: 1px solid #b4b4b4;
            border-radius: unset;
        }

        label input.form-control:focus,
        label input.form-control:active,
        label input.form-control:focus-within {
            outline: none;
            border-bottom: 1px solid #7fabfd;
        }

        table thead {
            background: #F2F2F2 !important;
        }

        table tr th {
            font-weight: normal;
            border: none !important;
        }

    </style>
    <style type="text/css">
        #tipo_doc{
            color:#fff; padding:5px; border-radius: 4px;
        }
        #tipo_doc.opcional{
            background-color:#25B82B;
            text-transform: capitalize;
        }
        #tipo_doc.obligatorio{
            background-color:#DD3939;
            text-transform: capitalize;
        }
        #tipo_doc.aplica{
            background-color:#FA8E1C;
        }
        #tipo_doc.aplica::before{
            content: "Solo si ";
        }


        .archivo_false{
            background-color: green;
            padding: 5px;
            border-radius: 4px;
            color: #fff;
        }
        .archivo_false::before{
            content: "Actual";
        }
        .archivo_true{
            background-color: red;
            padding: 5px;
            border-radius: 4px;
            color: #fff;
        }
        .archivo_true::before{
            content: "Archivado";
        }
    </style>
    {{-- @livewire('expediente-empleado-component', ['empleado' => $empleado]) --}}
    <div action="{{ route('admin.empleado.storeDocumentos', $empleado) }}" method="POST" id="formDocumentos">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="nombre"><i class="fas fa-edit iconos-crear"></i>Nombre del documento</label>
                <select class="form-control" name="nombre" id="nombre_doc">
                    <option value="" selected disabled>Selecciones documento</option>
                    @forelse($lista_docs as $list_doc)
                        <option 
                            data-activar="{{ $list_doc->activar_numero ? 'si' : 'no'}}" 
                            data-tipo="{{ $list_doc->tipo }}"
                            value="{{ $list_doc->documento }}">

                                {{ $list_doc->documento }}
                        </option>
                     @empty
                        <option>sin documentos</option>
                    @endforelse
                </select>
            </div>

            {{-- <div class="form-group col-sm-6">
                <label for="nombre"><i class="fas fa-edit iconos-crear"></i>Nombre del documento</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                    id="nombre_doc" value="{{ old('nombre', '') }}">
                <small id="nombre_error" class="errors text-danger"></small>
            </div> --}}

            <div class="form-group col-sm-6 d-none" id="group_numero_activo">
                <label for="numero"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text" name="numero"
                    id="numero_doc" value="{{ old('numero', '') }}">
                <small id="numero_error" class="errors text-danger"></small>
            </div>
            <div class="form-group col-12 ml-1" id="group_tipo_doc">
                 <strong>Tipo: </strong><font id="tipo_doc" class=""></font>
            </div>
            <div class="col-sm-12 col-md-12 col-12">
                <label for="documentos"><i class="fas fa-folder-open iconos-crear"></i>Documento</label><i
                    class="fas fa-info-circle" style="font-size:12pt; float: right;" title=""></i>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="file" class="form-control" id="documentos_doc">
                        <small id="file_error" class="errors text-danger"></small>
                        {{-- <label class="custom-file-label" for="inputGroupFile01">Selecciona un archivo</label> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" style="text-align: end">
            <button class="btn btn-success" type="submit" id="btnGuardarDocumento">Guardar</button>
        </div>
    </div>
    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="tbl-documentos" style="width:100% !important">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Número</th>
                    <th>Documento</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="col-sm-12 col-md-12 col-12 px-0" id="documentosGrid"></div>



