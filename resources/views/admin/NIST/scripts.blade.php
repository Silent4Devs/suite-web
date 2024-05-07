<script type="text/javascript">
    console.log('si');
    Livewire.on('planStore', () => {
        $('#planAccionModal').modal('hide');
        $('.modal-backdrop').hide();
        toastr.success('Plan de Trabajo creado con éxito');
    });
    window.initSelect2 = () => {
        $('.select2').select2({
            'theme': 'bootstrap4'
        });
    }

    initSelect2();

    Livewire.on('select2', () => {
        initSelect2();
    });
</script>
