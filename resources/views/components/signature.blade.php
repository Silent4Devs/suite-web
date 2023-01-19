<h3>REGISTRO DE SALIDA</h3>
<span style="font-size: 18px">Por favor,firma tu salida para
    completar tu
    registro</span>
<div class="wrapper" style="border: 1px dotted gray">
    <canvas {{ $attributes }} id="signature-pad"
        style="width: 100%; @error('firma') border: 2px solid red !important; @enderror" class="signature-pad" width=320
        height=250></canvas>
</div>
<div>
    <i id="clear" style="cursor: pointer; font-size: 25px;" class="bi bi-trash"></i>
    <div>
        @error('firma')
            <strong class="text-danger">
                <i class="bi bi-info-circle mr-2"></i> {{ $message }}
            </strong>
        @enderror
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
    });
    signaturePad.addEventListener("afterUpdateStroke", (data) => {
        let attributes = @json($attributes->get('wire:model'));
        @this.set(attributes, signaturePad.toDataURL('image/png'), true);

    });
    // var saveButton = document.getElementById('save');
    var cancelButton = document.getElementById('clear');

    // saveButton.addEventListener('click', function(event) {
    //     var data = signaturePad.toDataURL('image/png');

    //     // Send data to server instead...
    //     window.open(data);
    // });

    cancelButton.addEventListener('click', function(event) {
        signaturePad.clear();
    });
</script>
