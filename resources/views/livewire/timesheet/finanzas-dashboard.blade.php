<div>
    <div class="card card-body">
        <form wire:submit="search(Object.fromEntries(new FormData($event.target)))">
            <div class="row">
                <div class="col-md-5 ">
                    <div class="form-group ">
                        <label for="">Seleccione Proyecto</label>
                        <select name="proyecto" id="" class="form-control">
                            <option value="" disabled selected></option>
                            @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">
                                    {{ $proyecto->proyecto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 form-group">
                    <label for="">Fecha</label>
                    <input type="month" name="mes" class="form-control">
                </div>
                <div class="col-md-2 form-group">
                    <br>
                    <button class="btn tb-btn-primary">
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <canvas id="graf-financiero-1" width="400" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    let graf_general_1;
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('datosActualizados', (nombre, horastrabajada, horaTotal, horaCosto, proyectos) => {
            document.getElementById('graf-financiero-1').innerHTML = '';
            graf_general_1 && graf_general_1.destroy();
            const colors = generarColoresPasteles(nombre.length);
            initChart(nombre, horastrabajada, colors);
            InsertarDatos(horaCosto, horaTotal, proyectos);
        });

        function initChart(nombres, horas, colors) {
            graf_general_1 = new Chart(document.getElementById('graf-financiero-1'), {
                type: 'bar',
                data: {
                    labels: nombres,
                    datasets: [{
                        data: horas,
                        backgroundColor: colors,
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            top: 20
                        }
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    plugins: {
                        datalabels: {
                            color: '#fff',
                            display: false,
                            font: {
                                size: 20
                            }
                        },
                    },
                }
            });
        }

        function generarColoresPasteles(cantidad) {
            const colores = [];
            for (let i = 0; i < cantidad; i++) {
                const color = generarColorPastel();
                colores.push(color);
            }
            return colores;
        }

        function generarColorPastel() {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            // Convertir RGB a formato hexadecimal
            const colorHex = rgbToHex(r, g, b);
            return colorHex;
        }

        function rgbToHex(r, g, b) {
            return '#' + componentToHex(r) + componentToHex(g) + componentToHex(b);
        }

        function componentToHex(c) {
            const hex = c.toString(16);
            return hex.length == 1 ? '0' + hex : hex;
        }

        function InsertarDatos(costoTotal, totalHoras, proyectos) {
            var contentCard = document.getElementById("contentCard");
            contentCard.style.display = "block";
            document.getElementById("CostoTotal").textContent = costoTotal.toFixed(2);
            document.getElementById("TotalHoras").textContent = totalHoras.toFixed(2);
            var nombreProyecto = proyectos.proyecto;
            document.getElementById("nombreProyecto").textContent = nombreProyecto;
        }

    });
</script>
