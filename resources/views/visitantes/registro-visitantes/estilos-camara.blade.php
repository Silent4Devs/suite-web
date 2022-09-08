<style>
    .screenshot-image {
        width: 150px;
        height: 90px;
        border-radius: 4px;
        border: 2px solid whitesmoke;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
        position: absolute;
        bottom: 5px;
        left: 10px;
        background: rgb(0, 0, 0);
    }

    .display-cover {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70%;
        margin: 5% auto;
        position: relative;
    }

    video {
        width: 100%;
        background: url({{ asset('assets/camera@2x.png') }}) no-repeat center center;
        border-radius: 10px;
        position: relative;
        background-size: contain;
        color: black;
    }

    #cerrarCanvasFoto {
        position: absolute;
        top: -13px;
        right: -8px;
        padding: 10px;
        border-radius: 100%;
        z-index: 1;
        cursor: pointer;
    }

    .video-options {
        position: absolute;
        left: 20px;
        top: 27px;
    }

    .controls {
        position: absolute;
        right: 20px;
        top: 20px;
        display: flex;
    }

    .controls>button {
        width: 45px;
        height: 45px;
        text-align: center;
        border-radius: 100%;
        margin: 0 6px;
        background: transparent;
    }

    .controls>button:hover svg {
        color: rgb(0, 0, 0) !important;
    }

    @media (min-width: 300px) and (max-width: 400px) {
        .controls {
            flex-direction: column;
        }

        .controls button {
            margin: 5px 0 !important;
        }
    }

    .controls>button>svg {
        height: 20px;
        width: 18px;
        text-align: center;
        margin: 0 auto;
        padding: 0;
    }


    .controls button i {
        color: black;
    }


    .controls>button {
        width: 45px;
        height: 45px;
        text-align: center;
        border-radius: 100%;
        margin: 0 6px;
        background: transparent;
    }

    .controls>button:hover svg {
        color: rgb(0, 0, 0);
    }

    .btn i,
    .btn .c-icon {
        margin: auto;
        color: white;
        font-size: 18px;
        margin-top: 5px;
        margin-right: 2px;
    }

    .btn.stop {
        border: 2px solid red;
    }

    select.devices {
        appearance: none;
        background-color: transparent;
        border: none;
        padding: 0 1em 0 0;
        margin: 0;
        width: 100%;
        min-width: 15ch;
        max-width: 30ch;
        font-family: inherit;
        font-size: inherit;
        cursor: inherit;
        line-height: inherit;
        outline: none;
        cursor: pointer;
        border: solid 2px #6169ff;
        color: rgb(0, 0, 0);
        padding: 0 27px 0 10px;
    }

    select.devices:hover {
        background: #6169ff;
        color: rgb(0, 0, 0);
    }

    select.devices::-ms-expand {
        display: none;
    }

    .errors {
        color: red;
        font-size: 10pt;
    }
</style>
