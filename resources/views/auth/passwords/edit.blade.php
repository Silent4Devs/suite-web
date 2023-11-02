@extends('layouts.admin')
@section('content')
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
            border-radius: 50%;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

        .cropper-crop-box,
        .cropper-view-box {
            border-radius: 50%;
        }

        .cropper-view-box {
            box-shadow: 0 0 0 1px #39f;
            outline: 0;
        }

        .form-group label {
            color: #3086AF;
        }

        .card {
            background-color: #FCFCFC;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />

    <h5 class="col-12 titulo_general_funcion">Configurar Perfil</h5>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @include('partials.flashMessages')
                <div class="row">
                    <div class="col-sm-5 col-lg-5 col-5">
                        <div class="row">
                            <div class="text-center col-sm-12 col-lg-12 col-12 justify-content-center align-items-center">
                                <div class="card">
                                    <div class="card-body" style="background-color: #788BAC; color:#fff;">
                                        @if (auth()->user()->empleado)
                                            <div>
                                                <img class="rounded-circle"
                                                    style="height: 140px;clip-path: circle(70px at 50% 50%); position: relative; display:initial"
                                                    src="{{ asset('storage/empleados/imagenes/' . '/' . auth()->user()->empleado->avatar) }}"
                                                    alt="{{ auth()->user()->empleado->name }}">
                                                <label for="imgProfile"
                                                    style="position: relative;bottom: -73px;right: 53px;font-size: 18px;"><i
                                                        class="fas fa-camera"></i></label>
                                                <input id="imgProfile" type="file" name="image" class="image"
                                                    style="display:none">
                                            </div>
                                            <div class="mt-1">
                                                <h6 style="color: #fff; font-size: 20px !important; margin-top: 31px;">
                                                    {{ auth()->user()->empleado->name }}
                                                </h6>
                                                <p class="m-0">
                                                    <i class="fa fa-at"></i> Email:
                                                    {{ auth()->user()->empleado->email }}
                                                </p>
                                                <p class="mt-2">
                                                    @foreach (auth()->user()->roles as $rol)
                                                        <span class="badge"
                                                            style="font-size:13px; background-color: #006DDB">{{ $rol->title }}</span>
                                                    @endforeach
                                                </p>
                                            </div>
                                        @else
                                            <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 style="font-size:18px;">{{ trans('global.change_password') }}</h6>
                                        <hr>
                                        <form method="POST" action="{{ route('profile.password.update') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="required" for="title">Nueva
                                                    contraseña</label>
                                                <input
                                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                    type="password" name="password" id="password" required>
                                                @if ($errors->has('password'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="required" for="title">Confirmar nueva
                                                    {{ trans('cruds.user.fields.password') }}</label>
                                                <input class="form-control" type="password" name="password_confirmation"
                                                    id="password_confirmation" required>
                                            </div>
                                            <div class="form-group" style="text-align: end">
                                                <button class="btn btn-danger" type="submit">
                                                    {{ trans('global.save') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>











                            </div>
                        </div>
                    </div>

                    <div class="col-sm-7 col-lg-7 col-7">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-12">
                                <div class="card">

                                    <div class="card-body" style="height:340px !important;">
                                        <h6 style="font-size:18px;">Datos de perfil</h6>
                                        <hr>
                                        <form method="POST" action="{{ route('admin.empleado.update-profile') }}"
                                            class="row">
                                            @csrf
                                            <div class="form-group col-6">
                                                <label class="required"
                                                    for="name">{{ trans('cruds.user.fields.name') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    type="text" name="name" id="name"
                                                    value="{{ old('name', auth()->user()->empleado->name) }}" required
                                                    readonly disabled>
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="required"
                                                    for="title">{{ trans('cruds.user.fields.email') }}</label>
                                                <input
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    type="text" name="email" id="email" readonly disabled
                                                    value="{{ old('email', auth()->user()->empleado->email) }}">
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="cumpleaños" class="required">Fecha de nacimiento</label>
                                                <input
                                                    class=" form-control {{ $errors->has('cumpleaños') ? 'is-invalid' : '' }}"
                                                    type="date" name="cumpleaños" id="cumpleaños"
                                                    value="{{ old('cumpleaños', auth()->user()->empleado->cumpleaños) }}">
                                                @if ($errors->has('cumpleaños'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('cumpleaños') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Teléfono móvil</label>
                                                <input
                                                    class="form-control {{ $errors->has('telefono_movil') ? 'is-invalid' : '' }}"
                                                    type="tel" name="telefono_movil" id="telefono_movil"
                                                    value="{{ old('telefono_movil', auth()->user()->empleado->telefono_movil) }}">
                                                @if ($errors->has('telefono_movil'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('telefono_movil') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-check col-12"
                                                style="display:flex; justify-content:space-between; padding-left: 42px;">
                                                <input type="checkbox" class="form-check-input" id="ValidacionNumero"
                                                    name="mostrar_telefono"
                                                    {{ auth()->user()->empleado->mostrar_telefono ? 'checked' : '' }}>
                                                <label class="form-check-label" for="exampleCheck1"
                                                    style="font-size:12px; margin-top: 3px;">Mostrar mi telefono en directorio
                                                    organizacional</label>
                                                <button class="btn btn-danger" type="submit">
                                                    {{ trans('global.save') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 15px;">
                                <div class="col-sm-12 col-lg-12 col-12">
                                    @if (Route::has('profile.password.toggleTwoFactor'))
                                        <div class="card">
                                            <div class="card-body" style="height:330px !important;width:500px !important;">
                                                <form method="POST"
                                                    action="{{ route('profile.password.toggleTwoFactor') }}"
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    @csrf
                                                    <h6 style="font-size:18px;">Doble factor de autenticación <i class="fas fa-question-circle ml-2" title="Medida de seguridad adicional en la que además de ingresar tu usuario y contraseña se te enviará un código al correo electrónico corporativo para acceder a la plataforma Tabantaj."></i></h6>
                                                    <button class="btn btn-danger" type="submit">
                                                        {{ auth()->user()->two_factor ? 'Deshabilitar' : 'Habilitar' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>



                        </div>
                    </div>



                    @if (!auth()->user()->isAdmin)
                        @foreach (auth()->user()->roles as $rol)
                            <div class="col-12">
                                <div class="card card-body">
                                    <h6 style="font-size:18px;">Permisos del usuario</h6>
                                    <hr>
                                    <table class="table w-100" id="tblPermisos">
                                        <thead>
                                            <th>No.</th>
                                            <th>Nombre</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($rol->permissions as $idx => $permission)
                                                <tr>
                                                    <td>{{ $idx + 1 }}</td>
                                                    <td>{{ $permission->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12 col-12">
                        <div class="card">
                            <div class="card-body" style="height:355px !important;">
                                <h6 style="font-size:18px;">Contactos de emergencia</h6>
                                <hr style="opacity: 0;">
                                <form
                                    action="{{ route('admin.empleado.update-related-info-profile') }}"
                                    method="POST">
                                    @csrf
                                    @include('admin.empleados.components.contactos-emergencia',[
                                    'empleado'=>auth()->user()->empleado
                                    ])
                                    <div class="form-group" style="text-align: end">
                                        <button class="btn btn-danger" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12 col-12">
                        <div class="card card-body card_vacia">
                            <div class="row card_admin_oculto">
                                @if (auth()->user()->isAdmin)
                                    <div class="col-6">
                                        <h6 style="font-size:18px;">Permisos del usuario</h6>
                                    </div>
                                    <div class="col-6" style="font-size:10px; color: #fff;">

                                        <div class=""
                                            style="background-color:#006DDB; padding: 10px;">
                                            <i class="mr-2 fa fa-info-circle"></i>El administrador tiene todos los
                                            permisos
                                        </div>

                                    </div>
                                @else
                                    <div class="col-6">
                                        <h6 style="font-size:18px;">Permisos del usuario</h6>
                                    </div>
                                    <div class="col-6" style="font-size:10px; color: #fff;">

                                        <div class=""
                                            style="background-color:#4B4C4F; padding: 10px;">
                                            <i class="mr-2 fa fa-info-circle"></i>El
                                            {{ auth()->user()->roles[0]->title }} tiene los siguientes permisos
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="mt-3 row">

                        <div class="col-sm-12 col-lg-6 col-12">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('global.delete_account') }}
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('profile.password.destroyProfile') }}"
                                                onsubmit="return prompt('{{ __('global.delete_account_warning') }}') == '{{ auth()->user()->email }}'">
                                                @csrf
                                                <div class="form-group">
                                                    <button class="btn btn-danger" type="submit">
                                                        {{ trans('global.delete') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                <div class="row">

                </div>

            </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Selecciona el área de la imágen
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                </div>
                                <div class="row col-md-4 justify-content-center">
                                    <div class="text-center col-12">
                                        <p class="m-0 badge badge-primary">Previsualización</p>
                                    </div>
                                    <div class="preview" style="width: 160px; height: 160px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="crop">Cambiar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script>
        $(document).ready(function() {
            $('#tblPermisos').DataTable({
                buttons: [],
                searching: false
            })
        });
    </script>

    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                minWidth: 256,
                minHeight: 256,
                maxWidth: 4096,
                maxHeight: 4096,
                fillColor: '#fff',
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });
            roundedCanvas = getRoundedCanvas(canvas);

            roundedCanvas.toBlob(function(blob) {
                var url = URL.createObjectURL(blob);
                var reader = new FileReader();
                const urlRequest = `/admin/empleado/update-image-profile`;
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        url: urlRequest,
                        data: {
                            'image': base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            if (data.success) {
                                toastr.success(data.success)
                            }
                            if (data.error) {
                                toastr.error(data.error)
                            }
                            setTimeout(() => {
                                window.location.href = "/profile/password"
                            }, 1500);
                        }
                    });
                }
            });
        })

        function getRoundedCanvas(sourceCanvas) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const width = sourceCanvas.width;
            const height = sourceCanvas.height;

            canvas.width = width;
            canvas.height = height;
            context.imageSmoothingEnabled = true;
            context.drawImage(sourceCanvas, 0, 0, width, height);
            context.globalCompositeOperation = 'destination-in';
            context.beginPath();
            context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
            context.fill();
            return canvas;
        }
    </script>
@endsection
