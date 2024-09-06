@extends('layouts.admin')
@section('content')
    <livewire:catalogue-training.catalogue-training/>
    <script>
        document.addEventListener('saved', event => {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Registro guardado exitosamente",
                showConfirmButton: false,
                timer: 1500
            });
        });
        document.addEventListener('edited', event => {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Registro editado exitosamente",
                showConfirmButton: false,
                timer: 1500
            });
        });
        document.addEventListener('nameValidation', event => {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "El nombre de la capacitación ya esta registrado",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endsection
