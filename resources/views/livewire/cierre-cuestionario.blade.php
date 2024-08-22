<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div wire:ignore>
        <canvas id="signatureCanvas" width="400" height="200"></canvas>
    </div>

    <button wire:click="saveSignature">Save Signature</button>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            var canvas = document.getElementById('signatureCanvas');
            var context = canvas.getContext('2d');

            var isDrawing = false;
            var lastX = 0;
            var lastY = 0;

            canvas.addEventListener('mousedown', function(e) {
                isDrawing = true;
                [lastX, lastY] = [e.offsetX, e.offsetY];
            });

            canvas.addEventListener('mousemove', function(e) {
                if (!isDrawing) return;
                context.beginPath();
                context.moveTo(lastX, lastY);
                context.lineTo(e.offsetX, e.offsetY);
                context.stroke();
                [lastX, lastY] = [e.offsetX, e.offsetY];
            });

            canvas.addEventListener('mouseup', function() {
                isDrawing = false;
            });

            canvas.addEventListener('mouseleave', function() {
                isDrawing = false;
            });
        });
    </script>
@endpush
