@extends('layouts.admin')
@section('content')

    <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Vista del documento:
                        {{ $documento->archivo }}</strong></h3>
                <iframe src="{{ asset($path_documento . '/' . $documento->archivo) }}" class="mt-5 w-100"
                    style="height: 800px" frameborder="0"></iframe>
            </div>

    </div>

@endsection
