<div>
    <div class="chatbot">
        <div class="icon-fixed-chat"
            onclick="document.querySelector('.chatbot-chat-box').classList.toggle('active');">
            <img src="{{ asset('img/global/chatbot.jpg') }}" alt="Chatbot">
        </div>
        <div class="chatbot-chat-box">
            <div class="icon-chat">
                <img src="{{ asset('img/global/chatbot.jpg') }}" alt="Chatbot">
            </div>
            <div class="title-chatbot">
                Chatbot
                <hr>
            </div>
            <div class="chat-content scroll_estilo">
                <div class="ms-chat">
                    Hola, ¿Cómo puedo ayudarte hoy?
                </div>
                <div class="ms-user">
                    @if ($respuesta = $this->respuesta['response'] ?? null)
                        {{ $respuesta }}
                    @endif
                </div>
            </div>
            <form action="">
                <div class="box-input-user-chatbot">
                    <input wire:model.lazy="search" wire:click.prevent="askAsisten" name="" id="" class="scroll_estilo"></input>
                    <button class="btn">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
