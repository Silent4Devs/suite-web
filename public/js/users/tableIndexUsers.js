(function () {
    // Search function
    $.fn.dataTable.Api.register("alphabetSearch()", function (searchTerm) {
        this.iterator("table", function (context) {
            context.alphabetSearch = searchTerm;
        });

        return this;
    });

    // Recalculate the alphabet display for updated data
    $.fn.dataTable.Api.register(
        "alphabetSearch.recalc()",
        function (searchTerm) {
            this.iterator("table", function (context) {
                draw(
                    new $.fn.dataTable.Api(context),
                    $("div.alphabet", this.table().container())
                );
            });

            return this;
        }
    );

    // Search plug-in
    $.fn.dataTable.ext.search.push(function (context, searchData) {
        // Ensure that there is a search applied to this table before running it
        if (!context.alphabetSearch) {
            return true;
        }

        if (searchData[1].charAt(0) === context.alphabetSearch) {
            return true;
        }

        return false;
    });

    // Private support methods
    function bin(data) {
        var letter,
            bins = {};

        for (var i = 0, ien = data.length; i < ien; i++) {
            letter = data[i].charAt(0).toUpperCase();

            if (bins[letter]) {
                bins[letter]++;
            } else {
                bins[letter] = 1;
            }
        }

        return bins;
    }

    function draw(table, alphabet) {
        alphabet.empty();

        var columnData = table.column(1).data();
        var bins = bin(columnData);

        $('<span class="clear active"/>')
            .data("letter", "")
            .data("match-count", columnData.length)
            .html("Todos")
            .appendTo(alphabet);

        for (var i = 0; i < 26; i++) {
            var letter = String.fromCharCode(65 + i);

            $("<span/>")
                .data("letter", letter)
                .data("match-count", bins[letter] || 0)
                .addClass(!bins[letter] ? "empty" : "")
                .html(letter)
                .appendTo(alphabet);
        }

        $('<div class="alphabetInfo"></div>').appendTo(alphabet);
    }

    $.fn.dataTable.AlphabetSearch = function (context) {
        var table = new $.fn.dataTable.Api(context);
        var alphabet = $('<div class="alphabet"/>');

        draw(table, alphabet);

        // Trigger a search
        alphabet.on("click", "span", function () {
            alphabet.find(".active").removeClass("active");
            $(this).addClass("active");

            table.alphabetSearch($(this).data("letter")).draw();
        });

        // Mouse events to show helper information
        alphabet
            .on("mouseenter", "span", function () {
                alphabet
                    .find("div.alphabetInfo")
                    .css({
                        opacity: 1,
                        left: $(this).position().left,
                        width: $(this).width(),
                    })
                    .html($(this).data("match-count"));
            })
            .on("mouseleave", "span", function () {
                alphabet.find("div.alphabetInfo").css("opacity", 0);
            });

        // API method to get the alphabet container node
        this.node = function () {
            return alphabet;
        };
    };

    $.fn.DataTable.AlphabetSearch = $.fn.dataTable.AlphabetSearch;

    // Register a search plug-in
    $.fn.dataTable.ext.feature.push({
        fnInit: function (settings) {
            var search = new $.fn.dataTable.AlphabetSearch(settings);
            return search.node();
        },
        cFeature: "A",
    });
})();

$(document).ready(function () {
    // Función para vincular empleados
    window.VincularEmpleado = function (nombre, user_id) {
        let id_empleado = document.getElementById(
            `id_empleado_${user_id}`
        ).value;
        $.ajax({
            type: "POST",
            url: "/admin/users/vincular",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id_empleado,
                user_id,
            },
            dataType: "JSON",
            beforeSend: function () {
                Swal.fire(
                    "¡Estamos Vinculando!",
                    `El usuario: ${nombre} está siendo vinculado`,
                    "info"
                );
            },
            success: function (response) {
                Swal.fire(
                    "Usuario Vinculado",
                    `El usuario: ${nombre} ha sido vinculado`,
                    "success"
                );
                $(`#vincularEmpleado${user_id}`).modal("hide");
                $(".modal-backdrop").hide();
                setTimeout(() => {
                    location.reload();
                }, 5000);
            },
            error: function (error) {
                $.each(
                    error.responseJSON.errors,
                    function (indexInArray, valueOfElement) {
                        $(`span.${indexInArray}_error`).text(valueOfElement[0]);
                        console.log(indexInArray, valueOfElement);
                    }
                );
                Swal.fire(
                    "Ocurrió un error",
                    `Error: ${error.responseJSON.message}`,
                    "error"
                );
            },
        });
    };

    // Inicializa select2 si es necesario
    $(".select2").select2();
});

$(document).ready(function () {
    let dtButtons = [
        {
            extend: "csvHtml5",
            title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
            text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
            className: "btn-sm rounded pr-2",
            titleAttr: "Exportar CSV",
            exportOptions: {
                columns: ["th:not(:last-child):visible"],
            },
        },
        {
            extend: "excelHtml5",
            title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
            text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
            className: "btn-sm rounded pr-2",
            titleAttr: "Exportar Excel",
            exportOptions: {
                columns: ["th:not(:last-child):visible"],
            },
        },
        {
            extend: "pdfHtml5",
            title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
            text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
            className: "btn-sm rounded pr-2",
            titleAttr: "Exportar PDF",
            orientation: "landscape",
            exportOptions: {
                columns: ["th:not(:last-child):visible"],
            },
            customize: function (doc) {
                doc.pageMargins = [5, 20, 5, 20];
                // doc.styles.tableHeader.fontSize = 6.5;
                // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
            },
        },
        {
            extend: "print",
            title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
            text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
            className: "btn-sm rounded pr-2",
            titleAttr: "Imprimir",
            exportOptions: {
                columns: ["th:not(:last-child):visible"],
            },
        },
        {
            extend: "colvis",
            text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
            className: "btn-sm rounded pr-2",
            titleAttr: "Seleccionar Columnas",
        },
        {
            extend: "colvisGroup",
            text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
            className: "btn-sm rounded pr-2",
            show: ":hidden",
            titleAttr: "Ver todo",
        },
        {
            extend: "colvisRestore",
            text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
            className: "btn-sm rounded pr-2",
            titleAttr: "Restaurar a estado anterior",
        },
    ];
    let btnAgregar = {
        text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
        titleAttr: "Agregar empleado",
        url: "users/create",
        className: "btn-xs btn-outline-success rounded ml-2 pr-3",
        action: function (e, dt, node, config) {
            let { url } = config;
            window.location.href = url;
        },
    };

    dtButtons.push(btnAgregar);

    var table = $("#dom").DataTable({
        buttons: dtButtons,
        language: {
            url: "{{ asset('js/Spanish.json') }}",
        },

        // dom: 'AlBfrtip',
        dom:
            "<'row align-items-center justify-content-center col-12'<'text-center col-12 col-sm-12 col-md-12 col-lg-12'A><'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
    });
});
