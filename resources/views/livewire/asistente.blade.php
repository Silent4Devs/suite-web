<div>
    <div class="chatbot">
        <div class="icon-fixed-chat" wire:click="toggleChatbox">
            <img src="{{ asset('img/global/chatbot.jpg') }}" alt="Chatbot">
        </div>
        <div class="chatbot-chat-box @if($chatboxOpen) active @endif">
            <div class="icon-chat">
                <img src="{{ asset('img/global/chatbot.jpg') }}" alt="Chatbot">
            </div>
            <div class="title-chatbot">
                Chatbot
                <hr>
            </div>
            <div class="chat-content scroll_estilo">
                <div class="ms-user" style="height: 3rem;">
                    Hola, ¿Cómo puedo ayudarte hoy?
                </div>
                @if ($respuesta = $this->respuesta['response'] ?? null)
                <div class="ms-chat"  style="width: 15rem;">
                       <p style="text-align: justify;"> {{ $respuesta }}</p>
                </div>
                @endif
            </div>
            <form wire:submit.prevent="askAsisten">
                <div class="box-input-user-chatbot">
                    <input wire:model.lazy="search" class="scroll_estilo">
                    <button type="submit" class="btn">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    {{-- <button wire:click='askAsistenText'>Guardar</button> --}}
</div>
