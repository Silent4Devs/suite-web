<div class="content-custom-design d-none">
    <button class="btn btn-close-custom"
        onclick="document.querySelector('.content-custom-design').classList.add('d-none')">
        <i class="material-symbols-outlined">close</i>
    </button>
    <p class="color-tbj " style="font-size: 20px; margin-top: 50px;">
        <strong>
            Personalización
        </strong>
    </p>

    <p class="mt-5">
        Modo
    </p>

    <div class="d-flex gap-2">
        <button class="btn border" onclick="document.querySelector('body').classList.remove('dark');">
            <i class="material-symbols-outlined" style="color: #7a7a7a">wb_sunny</i>
        </button>
        <button class="btn border" onclick="document.querySelector('body').classList.add('dark');">
            <i class="material-symbols-outlined" style="color: #7a7a7a">bedtime</i>
        </button>
    </div>

    <p class="mt-5">
        Colores
    </p>

    <div class="d-flex justify-content-between">
        <div class="item-color-tbj" style="background-color: #4870b2"
            onclick="document.documentElement.style.setProperty('--color-tbj', '#4870b2');"></div>
        <div class="item-color-tbj" style="background-color: #754b9a"
            onclick="document.documentElement.style.setProperty('--color-tbj', '#754b9a');"></div>
        <div class="item-color-tbj" style="background-color: #ac3b7b"
            onclick="document.documentElement.style.setProperty('--color-tbj', '#ac3b7b');"></div>
        <div class="item-color-tbj" style="background-color: #46a56b"
            onclick="document.documentElement.style.setProperty('--color-tbj', '#46a56b');"></div>
        <div class="item-color-tbj" style="background-color: #000327"
            onclick="document.documentElement.style.setProperty('--color-tbj', '#000327');"></div>
    </div>

    <p class="mt-5">
        Orientación del menú
    </p>

    <div class="d-flex justify-content-between">
        <div class="example-menu-position" style="border-top: 10px solid #8ec6ff;"
            onclick="document.querySelector('body').classList.add('menu-global-position-top');
            document.querySelector('body').classList.remove('menu-global-position-left', 'menu-global-position-right', 'menu-global-position-bottom');">
        </div>
        <div class="example-menu-position" style="border-left: 10px solid #8ec6ff;"
            onclick="document.querySelector('body').classList.add('menu-global-position-left');
            document.querySelector('body').classList.remove('menu-global-position-top', 'menu-global-position-right', 'menu-global-position-bottom');">
        </div>
        <div class="example-menu-position" style="border-bottom: 10px solid #8ec6ff;"
            onclick="document.querySelector('body').classList.add('menu-global-position-bottom');
            document.querySelector('body').classList.remove('menu-global-position-top', 'menu-global-position-right', 'menu-global-position-left');">
        </div>
        <div class="example-menu-position" style="border-right: 10px solid #8ec6ff;"
            onclick="document.querySelector('body').classList.add('menu-global-position-right');
            document.querySelector('body').classList.remove('menu-global-position-top', 'menu-global-position-left', 'menu-global-position-bottom');">
        </div>
    </div>

    <p class="mt-5">
        Estilo
    </p>

    <div class="d-flex gap-4">
        <div class="d-flex align-items-center flex-column"
            onclick="document.querySelector('body').classList.remove('transparente');">
            <small style="font-size: 10px;">Clasico</small>
            <div class="example-menu-position" style="border-top: 10px solid #8ec6ff;"></div>
        </div>
        <div class="d-flex align-items-center flex-column"
            onclick="document.querySelector('body').classList.add('transparente');">
            <small style="font-size: 10px;">Transparente</small>
            <div class="example-menu-position" style="border-top: 10px solid #8ec6ff; background-color: #fff;"></div>
        </div>
    </div>
</div>
