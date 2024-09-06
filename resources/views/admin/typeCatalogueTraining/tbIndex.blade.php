@extends('layouts.admin')
@section('content')
    <livewire:catalogue-training.type-catalogue-training />

    <script>
        document.addEventListener('saved', event => {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Registro guardado",
                showConfirmButton: false,
                timer: 1000
            });
        });
    </script>
@endsection
