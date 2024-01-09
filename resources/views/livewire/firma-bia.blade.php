<div class="col-sm-6 form-group">
    <div x-data="signaturePad(@entangle('signature').live)">
        <h5 class="text-xl font-semibold text-gray-200 flex items-center justify-between"><span>{{$firmante}}</span></h5>
        <div>
            <canvas x-ref="signature_canvas" class="border rounded shadow">
    
            </canvas>
        </div>
    </div>
    <button class="btn btn-primary mt-2 " wire:click.prevent="submitSignatureEntrevistado()" >Guardar Firma</button>   
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('signaturePad', (value) => ({
                signaturePadInstance: null,
                value: value,
                init(){
                    this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
                    this.signaturePadInstance.addEventListener("endStroke", ()=>{
                       this.value = this.signaturePadInstance.toDataURL('image/png');
                    });
                },
            }))
        })
    </script>
</div>
