<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contenedorCards = document.getElementById('contendor-principal-me-deben-aprobar');
        const btnArchivoMeDebenAprobar = document.getElementById('btnArchivoMeDebenAprobar');
        const btnPrincipalesMeDebenAprobar = document.getElementById('btnPrincipalesMeDebenAprobar');

        // Iniciar con cards
        inicializarCapacitacionesGeneralesCards();

        if (btnArchivoMeDebenAprobar) {
            btnArchivoMeDebenAprobar.addEventListener('click', function(e) {
                const url = this.getAttribute('data-url');
                inicializarCapacitacionesGeneralesCards('Sin Aprobaciones Archivadas', 'todo', url);
            })
        }
        btnPrincipalesMeDebenAprobar?.addEventListener('click', function(e) {
            const url = this.getAttribute('data-url');
            inicializarCapacitacionesGeneralesCards('Sin Aprobaciones', 'todo', url);
        })

        async function inicializarCapacitacionesGeneralesCards(mensaje = "Sin Documentos", filtro = 'todo',
            url =
            "{{ route('admin.revisiones.obtenerDocumentosMeDebenAprobar') }}") {
            const cardsMisCapacitaciones = document.getElementById('cards-me-deben-aprobar');
            const cardsDeboAprobar = document.getElementById('cards-debo-aprobar');
            // cardsMisCapacitaciones.innerHTML = null; // limpiar el conenedor
            const formData = new FormData();
            formData.append('filtro', filtro)
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'),
                }
            });
            const documentos = await response.json();
            let html = "";
            if (documentos.length > 0) {
                let htmlMezcladas = `<div class="col-12" id="mezcladas"><div class="row">`;
                documentos.forEach(element => {
                    const icono = definirIconoParaCardPrincipal({
                        documento: element
                    });
                    htmlMezcladas += cardInformacionHTML({
                        documento: element
                    }, icono);
                });
                htmlMezcladas += "</div></div>";
                html += htmlMezcladas;
                cardsMisCapacitaciones.innerHTML = html;
                cardsDeboAprobar.innerHTML = html;
            } else {
                cardsMisCapacitaciones.innerHTML = sinCapacitaciones(mensaje);
                cardsDeboAprobar.innerHTML = sinCapacitaciones(mensaje);
            }
        }
        document.getElementById('cards-me-deben-aprobar').addEventListener('click', function(e) {
            if (e.target.getAttribute('data-historial-revisiones') == 'true') {
                // Podemos poner modal de historial de revisiones si se requiere
            }
        })


        function cardInformacionHTML(modelo, icono) {
            return `
            <div class="col-4 mb-2">
                <div id="carouselCapacitaciones${modelo.id}" class="carousel slide rounded p-2 bg-white" data-ride="carousel" style="height: 100%;">
                    <div class="col-12" style="text-align: right">
                     ${headerAuxCardHTML(modelo)}
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="deben-aprobar-card">
                                    <div class="px-4">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h6 class="card-title d-flex align-items-center" style="text-transform: capitalize;">
                                                    ${icono}
                                                    ${modelo.documento?.codigo} - ${modelo.documento?.nombre}
                                                </h6>
                                            </div>
                                        </div>
                                        <p class="m-0" style="font-size: 12px;color:${modelo.documento?.color_estatus}">${modelo.documento?.estatus_formateado}</p>
                                        <p class="m-0" style="font-size: 12px;">Versión: ${modelo.documento?.version}</p>
                                        <p class="m-0" style="font-size: 12px;text-transform:capitalize;">Tipo: ${modelo.documento?.tipo}</p>
                                        <p class="m-0" style="font-size: 12px">Fecha de Solicitud: ${modelo.documento?.fecha_dmy.replaceAll('-', '/')}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }

        function headerAuxCardHTML(modelo) {
            const estatus = Number(modelo.documento?.estatus);
            let html = `
            <a title="Historial de Revisiones del documento: ${modelo.documento?.nombre}" href="/admin/documentos/${modelo.documento?.id}/history-reviews">
                <i class="fas fa-clock text-muted" data-historial-revisiones="true" style="cursor: pointer;"></i>    
            </a>
            `;

            return html;
        }

        function sinCapacitaciones(mensaje) {
            let html = `
            <div class="col-12 text-center" id="sinCapacitaciones">
                    <p><strong style="text-transform: capitalize">${mensaje}</strong></p>
                    <img class="img-fluid" src="{{ asset('img/empleados_no_encontrados.svg') }}" alt="sin participante" width="300">
            </div>
            `;
            return html;
        }

        function definirIconoParaCardPrincipal(element) {
            const estatus = Number(element.documento.estatus);
            let icono = `<i class="far fa-question-circle mr-1 text-muted" style="font-size: 18px"></i>`;
            if (estatus == 3) {
                icono = `<i class="far fa-check-circle mr-1 text-success" style="font-size: 18px;"></i>`;
            } else if (estatus == 4) {
                icono = `<i class="far fa-times-circle mr-1 text-danger" style="font-size: 18px"></i>`;
            } else if (estatus == 5) {
                icono = `<i class="far fa-times-circle mr-1 text-muted" style="font-size: 18px"></i>`;
            }
            return icono;
        }

    })
</script>
