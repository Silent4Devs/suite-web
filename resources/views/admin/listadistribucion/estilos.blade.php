<head>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<style>
    .card-btns-distribucion {
        background-color: #F0F2FF91;
        height: 300px;
        width: 100%;
        border-radius: 14px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .card-btns-distribucion a {
        width: 225px;
        height: 95px;
        background-color: #fff;
        text-decoration: none !important;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        font-size: 16px;
        color: #2E2E2E;
        border-radius: 15px;
        border: 2px solid purple;
    }

    .card-btns-distribucion a i {
        font-size: 40px;
        color: purple;
    }

    .btn-crear {
        border: 1px solid #306BA9 !important;
        color: #306BA9 !important;
        background-color: #fff;
    }

    .estatus-global-vac {
        padding: 3px 6px;
        border-radius: 100px;
        font-size: 10px;
    }

    .card-body,
    .card.card-body {
        box-shadow: 0px 1px 4px #0000000F;
        border: 1px solid #E5E5E5;
        border-radius: 14px;
    }

    .card-header {
        background-color: #fff;
        margin-bottom: 8px;
    }

    .card h5 {
        color: #306BA9;
    }

    .instrucciones {
        background-color: #306BA9;
        border-radius: 8px;
        color: #fff;
        padding: 20px;
    }

    .instrucciones h5 {
        color: #fff;

    }

    .btn-verde {
        background-color: #00B212 !important;
        border-radius: 4px;
        opacity: 1;
        color: #fff;
    }

    .imgdoc {
        width: 150px;
        height: 150px;
        position: relative;
        top: 5px;
        left: 15px;
        /* UI Properties */
        background: transparent url('img/icono_onboarding.png') 0% 0% no-repeat padding-box;
        opacity: 1;
    }

    #btn_cancelar {
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        opacity: 1;
    }

    .anima-focus label {
        margin-top: -7px !important;

    }
</style>
