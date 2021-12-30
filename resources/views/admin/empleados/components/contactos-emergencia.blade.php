<table class="table" id="tblContactosEmergencia">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col" style="width: 20%;">Teléfono</th>
            <th scope="col">Parentesco</th>
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
                    <input class="form-control" type="hidden" name="contactos_emergencia[${position}][id]">
                    <input class="form-control" type="text" name="contactos_emergencia[${position}][nombre]">
                    <small class="text-danger" id="error_contactos_emergencia_${position}_nombre"></small>
                </td>    
                <td>
                    <input class="form-control" type="text" name="contactos_emergencia[${position}][telefono]">
                    <small class="text-danger" id="error_contactos_emergencia_${position}_telefono"></small>
                </td>    
                <td>
                    <input class="form-control" type="text" name="contactos_emergencia[${position}][parentesco]">
                    <small class="text-danger" id="error_contactos_emergencia_${position}_parentesco"></small>
                </td>`
            if (number > 1) {
                html += `
                        <td>
                            <button class="btn btn-secondary btn-xs removeContactoEmergencia" name="removeContactoEmergencia" id="">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#tblContactosEmergencia tbody').append(html);
            } else if (number == 1) {
                html += `
                        <td>
                            <button class="btn btn-primary btn-xs" name="addContactoEmergencia" id="addContactoEmergencia">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#tblContactosEmergencia tbody').append(html);
            }
        }
        let contactosEmergenciaInit = @json($empleado->contactosEmergencia);
        let contactosEmergenciaInitSize = contactosEmergenciaInit.length;
        let count = contactosEmergenciaInitSize > 0 ? contactosEmergenciaInitSize : 1;
        if (contactosEmergenciaInitSize) {
            let html;
            contactosEmergenciaInit.forEach((element, index) => {
                if (index == 0) {
                    html += `<tr>
                    <td>
                        <input class="form-control" type="hidden" value="${element.id}" name="contactos_emergencia[${index}][id]">
                        <input class="form-control" data-model-id="${element.id}" data-type-input="nombre"  type="text" value="${element.nombre}" name="contactos_emergencia[${index}][nombre]">
                        <small class="text-danger" id="error_contactos_emergencia_${index}_nombre"></small>
                    </td>    
                    <td>
                        <input class="form-control" data-model-id="${element.id}" data-type-input="telefono"   type="text" value="${element.telefono}"  name="contactos_emergencia[${index}][telefono]">
                        <small class="text-danger" id="error_contactos_emergencia_${index}_telefono"></small>    
                    </td>    
                    <td>
                        <input class="form-control" data-model-id="${element.id}" data-type-input="parentesco"  type="text" value="${element.parentesco}"  name="contactos_emergencia[${index}][parentesco]">
                        <small class="text-danger" id="error_contactos_emergencia_${index}_parentesco"></small>
                    </td>
                    <td>
                            <button class="btn btn-primary btn-xs" name="addContactoEmergencia" id="addContactoEmergencia">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </td>
                    </tr>`;
                } else {
                    html += `<tr>
                    <td>
                        <input class="form-control" type="hidden" value="${element.id}" name="contactos_emergencia[${index}][id]">
                        <input class="form-control" data-model-id="${element.id}" data-type-input="nombre"  type="text" value="${element.nombre}" name="contactos_emergencia[${index}][nombre]">
                        <small class="text-danger" id="error_contactos_emergencia_${index}_nombre"></small>
                    </td>    
                    <td>
                        <input class="form-control" data-model-id="${element.id}" data-type-input="telefono"  type="text" value="${element.telefono}"  name="contactos_emergencia[${index}][telefono]">
                        <small class="text-danger" id="error_contactos_emergencia_${index}_telefono"></small> 
                    </td>    
                    <td>
                        <input class="form-control" data-model-id="${element.id}" data-type-input="parentesco"  type="text" value="${element.parentesco}"  name="contactos_emergencia[${index}][parentesco]">
                        <small class="text-danger" id="error_contactos_emergencia_${index}_parentesco"></small>
                    </td>
                    <td>
                            <button data-model-id="${element.id}"  class="btn btn-secondary btn-xs removeEmergenciaWithFetch" name="removeContactoEmergencia" id="">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
                }
            });
            $('#tblContactosEmergencia tbody').append(html);
        } else {
            dynamicInputField(count);
        }
        $("#addContactoEmergencia").click(function(e) {
            e.preventDefault();
            count++
            dynamicInputField(count)
        })
        $(document).on('click', '.removeContactoEmergencia', function(e) {
            e.preventDefault();
            count--
            $(this).closest("tr").remove();
        })

        $("#tblContactosEmergencia").on('keyup', 'input', async function(e) {
            const target = e.target;
            const value = target.value;
            const empleadoId = target.getAttribute('data-model-id');
            const typeInput = target.getAttribute('data-type-input');
            if (typeInput && empleadoId) {
                const url = `/admin/recursos-humanos/contactos-emergencia-empleados/${empleadoId}`;
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

        $("#tblContactosEmergencia").on('click', '.removeEmergenciaWithFetch', function(e) {
            e.preventDefault();
            let target = e.target;
            if (target.tagName == 'I') {
                target = e.target.parentElement;
            }
            const empleadoId = target.getAttribute('data-model-id');
            console.log(empleadoId);
            const url = `/admin/recursos-humanos/contactos-emergencia-empleados/${empleadoId}`
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
