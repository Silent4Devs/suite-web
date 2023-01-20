<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    const contendorCanvas = document.getElementById('canvasFoto');
    const closeContenedorCanvas = document.getElementById('cerrarCanvasFoto');

    // feather.replace();

    const controls = document.querySelector('.controls');
    const cameraOptions = document.querySelector('.video-options>select');
    const video = document.querySelector('video');
    const canvas = document.querySelector('canvas');
    const screenshotImage = document.querySelector('.screenshot-image');
    const inputShotURL = document.getElementById('snapshoot');
    const buttons = [...controls.querySelectorAll('button')];
    console.log(buttons);
    let streamStarted = false;

    const [play, pause, stop, screenshot] = buttons;

    const constraints = {
        video: {
            width: {
                min: 1280,
                ideal: 1920,
                max: 2560,
            },
            height: {
                min: 720,
                ideal: 1080,
                max: 1440
            },
        }
    };

    cameraOptions.onchange = () => {
        const updatedConstraints = {
            ...constraints,
            deviceId: {
                exact: cameraOptions.value
            }
        };

        startStream(updatedConstraints);
    };

    play.onclick = (e) => {
        e.preventDefault();
        if (streamStarted) {
            video.play();
            play.classList.add('d-none');
            pause.classList.remove('d-none');
            return;
        }
        if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
            const updatedConstraints = {
                ...constraints,
                deviceId: {
                    exact: cameraOptions.value
                }
            };
            startStream(updatedConstraints);
        }
    };

    const stopStreamedVideo = (e) => {
        e.preventDefault();
        const stream = video.srcObject;
        if (stream != null) {
            const tracks = stream.getTracks();
            tracks.forEach(function(track) {
                track.stop();
            });
            video.srcObject = null;
            play.classList.remove('d-none');
            stop.classList.add('d-none');
            pause.classList.add('d-none');
            screenshot.classList.add('d-none');
        }
    }

    const pauseStream = (e) => {
        e.preventDefault();
        video.pause();
        play.classList.remove('d-none');
        pause.classList.add('d-none');
    };

    const doScreenshot = (e) => {
        e.preventDefault();
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        screenshotImage.src = canvas.toDataURL('image/webp');
        screenshotImage.classList.remove('d-none');
        let dataURL = canvas.toDataURL();
        inputShotURL.value = dataURL;
        @this.set('foto', dataURL);
        stopStreamedVideo(e);
    };
    stop.onclick = stopStreamedVideo;
    pause.onclick = pauseStream;
    screenshot.onclick = doScreenshot;

    const startStream = async (constraints) => {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleStream(stream);
    };


    const handleStream = (stream) => {
        video.srcObject = stream;
        play.classList.add('d-none');
        pause.classList.remove('d-none');
        stop.classList.remove('d-none');
        screenshot.classList.remove('d-none');
    };


    const getCameraSelection = async () => {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = devices.filter(device => device.kind === 'videoinput');
        const options = videoDevices.map(videoDevice => {
            return `<option value="${videoDevice.deviceId}">${videoDevice.label}</option>`;
        });
        cameraOptions.innerHTML = options.join('');
    };

    getCameraSelection();

    document.getElementById('cerrarCanvasFoto')?.addEventListener('click', function(e) {
        stopStreamedVideo(e);
        contendorCanvas.style.display = 'none';
    });


    $('.form-control-file').on('change', function(e) {
        let inputFile = e.currentTarget;
        $("#texto-imagen").text(inputFile.files[0].name);
        let dataURL = canvas.toDataURL();
        inputShotURL.value = "";
        stopStreamedVideo(e);
        contendorCanvas.style.display = 'none';
    });
</script>
