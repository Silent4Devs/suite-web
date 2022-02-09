<table class="table" id="tblBeneficiarios">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Edad</th>
            <th scope="col">Parentesco</th>
            <th scope="col">Porcentaje %</th>
            <th scope="col">Opción</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dynamicInputField = (number) => {
            let position = number - 1;
            let html = `<tr>
                <td>
                    <input class="form-control" type="hidden" name="beneficiarios[${position}][id]">
                    <input class="form-control" type="text" name="beneficiarios[${position}][nombre]">
                    <small class="text-danger" id="error_beneficiarios_${position}_nombre"></small>
                </td>
                <td>
                    <input class="form-control" type="text" name="beneficiarios[${position}][edad]">
                    <small class="text-danger" id="error_beneficiarios_${position}_edad"></small>
                </td>
                <td>
                    <input class="form-control" type="text" name="beneficiarios[${position}][parentesco]">
                    <small class="text-danger" id="error_beneficiarios_${position}_parentesco"></small>
                </td>
                <td>
                    <input class="form-control" type="number" name="beneficiarios[${position}][porcentaje]">
                    <small class="text-danger" id="error_beneficiarios_${position}_porcentaje"></small>
                </td>
            `
            if (number > 1) {
                html += `
                        <td>
                            <button class="btn btn-secondary btn-xs removeBeneficiario" name="removeBeneficiario" id="">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#tblBeneficiarios tbody').append(html);
            } else if (number == 1) {
                html += `
                        <td>
                            <button class="btn btn-primary btn-xs" name="addBeneficiario" id="addBeneficiario">
                                <i class="fas fa-plus-circle" style="font-size: 12px;text-align: center;margin: 0;"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#tblBeneficiarios tbody').append(html);
            }
        }

        let contactosEmergenciaInit = @json($empleado->beneficiarios);
        let contactosEmergenciaInitSize = contactosEmergenciaInit.length;
        let count = contactosEmergenciaInitSize > 0 ? contactosEmergenciaInitSize : 1;
        if (contactosEmergenciaInitSize) {
            let html;
            contactosEmergenciaInit.forEach((element, index) => {
                if (index == 0) {
                    html += `<tr>
                        <td>
                            <input class="form-control" type="hidden" value="${element.id}" name="beneficiarios[${index}][id]">
                            <input class="form-control" data-model-id="${element.id}" data-type-input="nombre" type="text" value="${element.nombre}" name="beneficiarios[${index}][nombre]">
                            <small class="text-danger" id="error_beneficiarios_${index}_nombre"></small>
                        </td>
                        <td>
                            <input class="form-control" data-model-id="${element.id}" data-type-input="edad" value="${element.edad}" type="text" name="beneficiarios[${index}][edad]">
                            <small class="text-danger" id="error_beneficiarios_${index}_edad"></small>
                        </td>
                        <td>
                            <input class="form-control" data-model-id="${element.id}" data-type-input="parentesco" value="${element.parentesco}" type="text" name="beneficiarios[${index}][parentesco]">
                            <small class="text-danger" id="error_beneficiarios_${index}_parentesco"></small>
                        </td>
                        <td>
                            <input class="form-control" data-model-id="${element.id}" data-type-input="porcentaje" value="${element.porcentaje}" type="number" name="beneficiarios[${index}][porcentaje]">
                            <small class="text-danger" id="error_beneficiarios_${index}_porcentaje"></small>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-xs" name="addBeneficiario" id="addBeneficiario">
                                <i class="fas fa-plus-circle" style="font-size: 12px;text-align: center;margin: 0;"></i>
                            </button>
                        </td>
                    </tr>`;
                } else {
                    html += `<tr>
                        <td>
                            <input class="form-control" type="hidden" value="${element.id}" name="beneficiarios[${index}][id]">
                            <input class="form-control" data-model-id="${element.id}" data-type-input="nombre" type="text" value="${element.nombre}" name="beneficiarios[${index}][nombre]">
                            <small class="text-danger" id="error_beneficiarios_${index}_nombre"></small>
                        </td>
                        <td>
                            <input class="form-control" data-model-id="${element.id}" data-type-input="edad" value="${element.edad}" type="text" name="beneficiarios[${index}][edad]">
                            <small class="text-danger" id="error_beneficiarios_${index}_parentesco"></small>
                        </td>
                        <td>
                            <input class="form-control" data-model-id="${element.id}" data-type-input="parentesco" value="${element.parentesco}" type="text" name="beneficiarios[${index}][parentesco]">
                            <small class="text-danger" id="error_beneficiarios_${index}_parentesco"></small>
                        </td>
                        <td>
                            <input class="form-control" data-model-id="${element.id}" data-type-input="porcentaje" value="${element.porcentaje}" type="number" name="beneficiarios[${index}][porcentaje]">
                            <small class="text-danger" id="error_beneficiarios_${index}_porcentaje"></small>
                        </td>
                        <td>
                            <button data-model-id="${element.id}" class="btn btn-secondary btn-xs removeBeneficiarioWithFetch" name="removeBeneficiario" id="">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
                }
            });
            $('#tblBeneficiarios tbody').append(html);
        } else {
            dynamicInputField(count);
        }


        $("#addBeneficiario").click(function(e) {
            e.preventDefault();
            count++
            dynamicInputField(count)
        })
        $(document).on('click', '.removeBeneficiario', function(e) {
            e.preventDefault();
            count--
            $(this).closest("tr").remove();
        })

        $("#tblBeneficiarios").on('keyup', 'input', async function(e) {
            const target = e.target;
            const value = target.value;
            const empleadoId = target.getAttribute('data-model-id');
            const typeInput = target.getAttribute('data-type-input');
            if (typeInput && empleadoId) {
                const url = `/admin/recursos-humanos/beneficiarios-empleados/${empleadoId}`;
                const response = await fetch(url, {
                    method: 'PUT',
                    body: JSON.stringify({
                        value,
                        typeInput
                    }),
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                })
                const data = await response.json();
                console.log(data);
            }
        })

        $("#tblBeneficiarios").on('click', '.removeBeneficiarioWithFetch', function(e) {
            e.preventDefault();
            let target = e.target;
            if (target.tagName == 'I') {
                target = e.target.parentElement;
            }
            const empleadoId = target.getAttribute('data-model-id');
            console.log(empleadoId);
            const url = `/admin/recursos-humanos/beneficiarios-empleados/${empleadoId}`
            Swal.fire({
                title: '¿Quieres eliminar este registro?',
                text: "Este dato ya está almacenado",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const response = await fetch(url, {
                        method: "DELETE",
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                    });
                    const data = await response.json();
                    count--
                    $(this).closest("tr").remove();
                    console.log(data);
                }
            })
        })
    })
</script>
