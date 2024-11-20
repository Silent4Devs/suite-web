@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Actualizar: Razón Social</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('contract_manager.sucursales.update', [$sucursales->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <label for="clave" class="asterisco">Clave*</label>
                        <input value="{{ old('clave', $sucursales->clave) }}"
                               class="form-control {{ $errors->has('clave') ? 'is-invalid' : '' }}" type="number"
                               name="clave" id="clave" required>
                        @if ($errors->has('clave'))
                            <div class="invalid-feedback">
                                {{ $errors->first('clave') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <label for="descripcion" class="asterisco">Descripción*</label>
                        <input value="{{ old('descripcion', $sucursales->descripcion) }}"
                               class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text"
                               name="descripcion" id="descripcion" required>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <label for="rfc" class="asterisco">RFC*</label>
                        <input value="{{ old('rfc', $sucursales->rfc) }}"
                               class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="text"
                               name="rfc" id="rfc" required>
                        @if ($errors->has('rfc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rfc') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <label for="empresa" class="asterisco">Empresa*</label>
                        <input value="{{ old('empresa', $sucursales->empresa) }}"
                               class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                               name="empresa" id="empresa" required>
                        @if ($errors->has('empresa'))
                            <div class="invalid-feedback">
                                {{ $errors->first('empresa') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <label for="cuenta_contable" class="asterisco">Cuenta Contable*</label>
                        <input value="{{ old('cuenta_contable', $sucursales->cuenta_contable) }}"
                               class="form-control {{ $errors->has('cuenta_contable') ? 'is-invalid' : '' }}" type="number"
                               name="cuenta_contable" id="cuenta_contable" required>
                        @if ($errors->has('cuenta_contable'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cuenta_contable') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <label for="zona" class="asterisco">Zona*</label>
                        <input value="{{ old('zona', $sucursales->zona) }}"
                               class="form-control {{ $errors->has('zona') ? 'is-invalid' : '' }}" type="text"
                               name="zona" id="zona" required>
                        @if ($errors->has('zona'))
                            <div class="invalid-feedback">
                                {{ $errors->first('zona') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <label for="direccion" class="asterisco">Dirección*</label>
                        <input value="{{ old('direccion', $sucursales->direccion) }}"
                               class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text"
                               name="direccion" id="direccion" required>
                        @if ($errors->has('direccion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('direccion') }}
                            </div>
                        @endif
                    </div>

                    <div class="col s12 l6 distancia anima-focus">
                        <label for="myfile" class="asterisco">Selecciona el logotipo*</label>
                        <input type="file" id="myfile" class="form-control" name="mylogo" required
                               accept="image/png,image/jpeg">
                        @if ($errors->has('mylogo'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('mylogo') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#roles").select2({
                theme: "bootstrap4",
            });
        });
    </script>
@endsection
