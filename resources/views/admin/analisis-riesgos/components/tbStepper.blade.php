<div>
    <style>
        :root{
            --color-primary: #467BD3;
        }
        .squares {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .boxes {
            margin-top: 20px;
            height: 100px;
            width: auto;
            font-family: "Open Sans", sans-serif;
        }

        .box {
            position: relative;
            display: flex;
            align-items: center;
            flex-direction: row;

            width: 100%;
            height: auto;

            padding: 0 30px;
            box-sizing: border-box;
        }

        .progress-stepper {
            position: relative;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
        }

        .bar {
            position: absolute;
            top: 50%;
            left: 50%;
            background: #e8dfd8;
            width: 100%;
            height: 3px;
            border-radius: 10px;
            transform: translate(-50%, -50%);
            overflow: hidden;
        }

        .bar__fill {
            display: block;
            background: var(--color-primary);
            height: 100%;
        }

        .point {
            position: relative;
            color: var(--color-primary);
            cursor: pointer;
        }

        .point:before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120px;
            height: 120px;
            border-radius: 100%;
            transform: translate(-50%, -50%);
            transition: 0.3s ease;
        }

        .show-radius .point:before {
            background: rgba(0, 0, 0, 0.1);
        }

        .point--complete,
        .point--active {
            color: var(--color-primary);
        }

        .bullet {
            z-index: 1;
            position: relative;
            background: var(--color-primary);
            width: 8px;
            height: 8px;
            border-radius: 100%;
            transition: 0.3s ease;
        }

        .point--complete .bullet,
        .point--active .bullet {
            background: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2), 0 0 0 6px var(--color-primary);
        }

        .point--active .bullet {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2), 0 0 0 10px var(--color-primary);
        }

        .label {
            position: absolute;
            top: 100%;
            left: 50%;
            margin: 20px 0 0 0;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            transform: translate(-50%, 0);
            /* white-space: nowrap; */
        }

        .radius-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
            display: block;
            background: var(--white);
            border: 0;
            border-radius: 4px;
            box-shadow: 40px 0 65px rgba(212, 197, 186, 0.4);
            padding: 10px;
            color: var(--color-primary);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>

    <div class="row justify-content-center align-items-center">
        <div class="col-xs-12 col-sm-8">
            <div class="boxes">
                <div class="box">
                    <div class="progress-stepper">
                        <div class="bar">
                            <div class="bar__fill" style="width: 0%;"></div>
                        </div>
                        <div class="point point--active">
                            <div class="bullet"></div>
                            <label class="label">Escalas</label>
                        </div>
                        <div class="point">
                            <div class="bullet"></div>
                            <label class="label">Template</label>
                        </div>
                        <div class="point">
                            <div class="bullet"></div>
                            <label class="label">Formulas</label>
                        </div>
                        <div class="point">
                            <div class="bullet"></div>
                            <label class="label">Configuracion</label>
                        </div>
                        <div class="point">
                            <div class="bullet"></div>
                            <label class="label">Vista Previa</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
