@extends('layouts.admin')
@section('content')
<livewire:catalogue-training.catalogue-training/>
{{-- <script>
    Swal.fire({
  position: "top-end",
  icon: "success",
  title: "Your work has been saved",
  showConfirmButton: false,
  timer: 1500
});
</script> --}}

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
{{-- <script>
    document.addEventListener('deleteMessage', event => {
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            @this.call('delete');
            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
            });
        }
        });
    });
</script> --}}
@endsection
