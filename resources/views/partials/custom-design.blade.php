<div class="content-custom-design invisible">
    <button class="btn btn-close-custom"
        onclick="document.querySelector('.content-custom-design').classList.add('invisible')">
        <i class="material-symbols-outlined">close</i>
    </button>
    <p class="color-tbj " style="font-size: 20px; margin-top: 50px;">
        <strong>
            Personalización
        </strong>
    </p>

    {{-- <p class="mt-5">
        Modo
    </p>

    <div class="d-flex gap-2">
        <button class="btn border btn-dark-mode btn-option-light" onclick="darkMode('light');">
            <i class="material-symbols-outlined">wb_sunny</i>
        </button>
        <button class="btn border btn-dark-mode btn-option-dark" onclick="darkMode('dark');">
            <i class="material-symbols-outlined">bedtime</i>
        </button>
    </div> --}}

    <p class="mt-5">
        Colores
    </p>

    <div class="d-flex justify-content-between">
        <div class="item-color-tbj" style="background-color: #4870b2" onclick="themeColor('#4870b2');"></div>
        <div class="item-color-tbj" style="background-color: #754b9a" onclick="themeColor('#754b9a');"></div>
        <div class="item-color-tbj" style="background-color: #ac3b7b" onclick="themeColor('#ac3b7b');"></div>
        <div class="item-color-tbj" style="background-color: #46a56b" onclick="themeColor('#46a56b');"></div>
        <div class="item-color-tbj" style="background-color: #000327" onclick="themeColor('#000327');"></div>
    </div>

    <p class="mt-5">
        Orientación del menú
    </p>

    <div class="d-flex justify-content-between">
        <div class="example-menu-position btn-menu-position" style="border-top: 10px solid #8ec6ff;"
            onclick="menuPosition('top');" data-position="top">
        </div>
        <div class="example-menu-position btn-menu-position" style="border-left: 10px solid #8ec6ff;"
            onclick="menuPosition('left');" data-position="left">
        </div>
        <div class="example-menu-position btn-menu-position" style="border-bottom: 10px solid #8ec6ff;"
            onclick="menuPosition('bottom');" data-position="bottom">
        </div>
        <div class="example-menu-position btn-menu-position" style="border-right: 10px solid #8ec6ff;"
            onclick="menuPosition('right');" data-position="right">
        </div>
    </div>

    <p class="mt-5">
        Estilo
    </p>

    <div class="d-flex gap-4">
        <div class="d-flex align-items-center flex-column btn-theme-estilo" onclick="themeContrast(false);"
            data-estilo="false">
            <small style="font-size: 10px;">Clasico</small>
            <div class="example-menu-position" style="border-top: 10px solid #8ec6ff;"></div>
        </div>
        <div class="d-flex align-items-center flex-column btn-theme-estilo" onclick="themeContrast(true);"
            data-estilo="true">
            <small style="font-size: 10px;">Transparente</small>
            <div class="example-menu-position" style="border-top: 10px solid #8ec6ff; background-color: #fff;"></div>
        </div>
    </div>

    <p class="mt-5">
        Menus
    </p>

    <div class="d-flex gap-4">
        <img src="{{ asset('img/custom/menu-1.png') }}" alt="Menu ejemplo" class="example-menu-position"
            style="width: 50px; " data-item="1" onclick="menuItem(1);">
        <img src="{{ asset('img/custom/menu-2.png') }}" alt="Menu ejemplo" class="example-menu-position"
            style="width: 50px; " data-item="2" onclick="menuItem(2);">
        <img src="{{ asset('img/custom/menu-3.png') }}" alt="Menu ejemplo" class="example-menu-position"
            style="width: 50px; " data-item="3" onclick="menuItem(3);">
    </div>

</div>

<script>
    const bodyElement = document.body;

    function darkMode(theme = 'light') {
        localStorage.setItem('theme', theme);

        if (theme === 'dark') {
            bodyElement.classList.add('dark');
        } else {
            bodyElement.classList.remove('dark');
        }
        document.querySelector('.btn-dark-mode:not(.btn-option-' + theme + ')').classList.remove('active');
        document.querySelector('.btn-dark-mode.btn-option-' + theme).classList.add('active');
    }

    function themeColor(color = '#4870b2') {
        localStorage.setItem('themeColor', color);
        document.documentElement.style.setProperty('--color-tbj', color);
    }

    function menuPosition(position = 'top') {
        localStorage.setItem('menuPosition', position);
        let positions = ['top', 'left', 'right', 'bottom'];
        positions.forEach(pst => {
            bodyElement.classList.remove('menu-global-position-' + pst);
        });
        bodyElement.classList.add('menu-global-position-' + position);
        if (document.querySelector('.btn-menu-position.active')) {
            document.querySelector('.btn-menu-position.active').classList.remove('active');
        }
        document.querySelector('.btn-menu-position[data-position="' + position + '"]').classList.add('active');

        console.log(localStorage.getItem('menuPosition'));
    }

    function themeContrast(contrast = false) {
        localStorage.setItem('themeContrast', contrast);
        console.log(localStorage.getItem('themeContrast'));
        if (contrast) {
            bodyElement.classList.add('transparente');
        } else {
            bodyElement.classList.remove('transparente');
        }
        if (document.querySelector('.btn-theme-estilo.active')) {
            document.querySelector('.btn-theme-estilo.active').classList.remove('active');
        }
        document.querySelector('.btn-theme-estilo[data-estilo="' + contrast + '"]').classList.add('active');
    }

    function menuItem(item = 1) {
        localStorage.setItem('menuItem', item);
        let items = [1, 2, 3];
        items.forEach(itm => {
            bodyElement.classList.remove('menu-modulo-' + itm);
        });
        bodyElement.classList.add('menu-modulo-' + item);
        if (document.querySelector('.btn-menu-item.active')) {
            document.querySelector('.btn-menu-item.active').classList.remove('active');
        }
        document.querySelector('.btn-menu-item[data-item="' + item + '"]').classList.add('active');
    }
</script>
<script>
    addEventListener("DOMContentLoaded", () => {
        themeContrast(JSON.parse(localStorage.getItem('themeContrast')) || false);
        menuPosition(localStorage.getItem('menuPosition') || 'top');
        themeColor(localStorage.getItem('themeColor') || '#4870b2');
        menuItem(localStorage.getItem('menuItem') || 1);
        // darkMode(localStorage.getItem('theme') || 'light');
    });
</script>
