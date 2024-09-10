@extends('layouts.admin')
@section('content')
    <livewire:catalogue-training.type-catalogue-training />

    <script>
        document.addEventListener('saved', event => {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Registro guardado exitosamente",
                showConfirmButton: false,
                timer: 1000
            });
        });
    </script>
    <script>
        document.addEventListener('edited', event => {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Registro editado exitosamente",
                showConfirmButton: false,
                timer: 1000
            });
        });
    </script>
    <script>
        document.addEventListener("click", function(e) {
            let btn = event.target;
            if (btn.classList.contains('btn-top')) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    </script>
@endsection
