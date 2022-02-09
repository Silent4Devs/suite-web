<table class="table" id="tblDependientes">
    <thead>
        <tr>
            <th scope="col" style="width: 45%;">Nombre</th>
            <th scope="col" style="width: 44%;">Parentesco</th>
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
                    <input class="form-control" type="hidden" name="dependientes[${position}][id]">
                    <input class="form-control" type="text" name="dependientes[${position}][nombre]">
                    <small class="text-danger" id="error_dependientes_${position}_nombre"></small>
                </td>
                <td>
                    <input class="form-control" type="text" name="dependientes[${position}][parentesco]">
                    <small class="text-danger" id="error_dependientes_${position}_parentesco"></small>
                </td>`
            if (number > 1) {
                html += `
                        <td>
                            <button class="btn btn-secondary btn-xs removeDependiente" name="removeDependiente" id="">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#tblDependientes tbody').append(html);
            } else if (number == 1) {
                html += `
                        <td>
                            <button class="btn btn-primary btn-xs" name="addDependiente" id="addDependiente">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#tblDependientes tbody').append(html);
            }
        }

        let dependientesEc = @json($empleado->dependientesEconomicos);
        let dependientesSize = dependientesEc.length;
        let count = dependientesSize > 0 ? dependientesSize : 1;
        if (dependientesSize) {
            let html;
            dependientesEc.forEach((element, index) => {
                if (index == 0) {
                    html += `<tr>
                    <td>
                        <input class="form-control" type="hidden" value="${element.id}" name="dependientes[${index}][id]">
                        <input class="form-control" type="text" data-model-id="${element.id}" data-type-input="nombre" value="${element.nombre}" name="dependientes[${index}][nombre]">
                        <small class="text-danger" id="error_dependientes_${index}_nombre"></small>
                    </td>
                    <td>
                        <input class="form-control" data-model-id="${element.id}" data-type-input="parentesco" type="text" value="${element.parentesco}" name="dependientes[${index}][parentesco]">
                        <small class="text-danger" id="error_dependientes_${index}_parentesco"></small>
                    </td>
                    <td>
                            <button class="btn btn-primary btn-xs" name="addDependiente" id="addDependiente">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </td>
                    </tr>`;
                } else {
                    html += `<tr>
                    <td>
                        <input class="form-control" type="hidden" value="${element.id}" name="dependientes[${index}][id]">
                        <input class="form-control" data-model-id="${element.id}" data-type-input="nombre" type="text" value="${element.nombre}" name="dependientes[${index}][nombre]">
                        <small class="text-danger" id="error_dependientes_${index}_nombre"></small>
                    </td>
                    <td>
                        <input class="form-control" data-model-id="${element.id}" data-type-input="parentesco" type="text" value="${element.parentesco}" name="dependientes[${index}][parentesco]">
                        <small class="text-danger" id="error_dependientes_${index}_parentesco"></small>
                    </td>
                    <td>
                            <button data-model-id="${element.id}" class="btn btn-secondary btn-xs removeWithFetch" name="removeDependiente" id="">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
                }
            });
            $('#tblDependientes tbody').append(html);
        } else {
            dynamicInputField(count);
        }

        $("#addDependiente").click(function(e) {
            e.preventDefault();
            count++
            dynamicInputField(count)
        })
        $(document).on('click', '.removeDependiente', function(e) {
            e.preventDefault();
            count--
            $(this).closest("tr").remove();
        })

        $("#tblDependientes").on('keyup', 'input', async function(e) {
            const target = e.target;
            const value = target.value;
            const empleadoId = target.getAttribute('data-model-id');
            const typeInput = target.getAttribute('data-type-input');
            if (typeInput && empleadoId) {
                const url = `/admin/recursos-humanos/dependientes-empleados/${empleadoId}`;
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

        $("#tblDependientes").on('click', '.removeWithFetch', function(e) {
            e.preventDefault();
            let target = e.target;
            if (target.tagName == 'I') {
                target = e.target.parentElement;
            }
            const empleadoId = target.getAttribute('data-model-id');
            console.log(empleadoId);
            const url = `/admin/recursos-humanos/dependientes-empleados/${empleadoId}`
            Swal.fire({
                title: '¿Quieres eliminar este dependiente?',
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
