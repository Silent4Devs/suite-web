<style>
    :root {
        --prm-color: #4285F4;
        --prm-color-light: #f5f5f5;
        --prm-gray: #dddddd;
        --prm-done-color: #42f468;
        --prm-color-alternative: #1C274A;
    }


    label {
        color: var(--prm-color);
    }

    .header-text {
        color: var(--prm-color-alternative);
    }

    .btn-primary,
    .btn-primary:hover {
        background: var(--prm-color-alternative);
        border: none;
        border-radius: 2px;
        width: 150px;
        padding: 10px 5px;
    }

    .steps {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .step-button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        background-color: var(--prm-gray);
        transition: .4s;
    }

    .step-button[aria-expanded="true"] {
        width: 60px;
        height: 60px;
        background-color: var(--prm-color);
        color: #fff;
    }

    .step-button i {
        font-size: 28px;
    }

    .done {
        background-color: var(--prm-done-color);
        color: #fff;
    }

    .step-item {
        z-index: 10;
        text-align: center;
    }

    #progress {
        -webkit-appearance: none;
        position: absolute;
        width: 90%;
        z-index: 5;
        height: 1px;
        margin-left: 50px;
        margin-bottom: 18px;
    }

    /* to customize progress bar */
    #progress::-webkit-progress-value {
        background-color: var(--prm-color);
        transition: .5s ease;
    }

    #progress::-webkit-progress-bar {
        background-color: var(--prm-gray);

    }
</style>
