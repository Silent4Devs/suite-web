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
                @if($firstMessageVisible)
                    <div class="ms-user" style="height: 3rem;">
                        <p style="text-align: justify; font-size: 10px;">Hola, ¿Cómo puedo ayudarte hoy?</p>
                    </div>
                @endif

                @foreach ($preguntas as $index => $pregunta)
                    <div class="ms-user" style="width: 15rem;">
                        <p style="text-align: justify; font-size: 10px;">{!! nl2br(e($pregunta)) !!}</p>
                    </div>

                    @if (isset($respuestas[$index]))
                        <div class="ms-chat" style="width: 15rem;">
                            <p style="text-align: justify; font-size: 10px;">{!! nl2br(e($respuestas[$index])) !!}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            <form wire:submit.prevent="askAsisten">
                <div class="box-input-user-chatbot">
                    <input wire:model.defer="search" class="scroll_estilo" style="border: 2px solid #add8e6; padding: 5px; border-radius: 4px; outline: none;">
                    <button type="submit" class="btn" style="border: 2px solid #add8e6; outline: none;">
                        <span wire:loading.remove>Enviar</span>
                        <span wire:loading>
                            <img src="{{ asset('img/load.gif') }}" alt="Loading..." style="width: 30px; height: 30px;">
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
