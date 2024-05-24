<div class="cardCalendario" style="box-shadow: none; !important">
    <div class="card-body" style="height: 550px;">
        <div id="sistema_gantt">
            <div id="ndo"
                style="position:absolute;right:5px;top:5px;width:378px;padding:5px;background-color: #FFF5E6; border:1px solid #F9A22F; font-size:12px; display: none;"
                class="noprint">
                This Gantt editor is free thanks to <a href="http://twproject.com" target="_blank">Twproject</a> where
                it can be
                used on a complete and flexible project management solution.<br> Get your projects done! Give <a
                    href="http://twproject.com" target="_blank">Twproject a try now</a>.
            </div>
            <div id="workSpace" data-url-save="{{ route('admin.planes-de-accion.saveProject', $planImplementacion) }}"
                data-url-assigs={{ asset('storage/empleados/imagenes') }}
                style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px">
            </div>

            <form id="gimmeBack" style="display:none;" action="../gimmeBack.jsp" method="post" target="_blank"><input
                    type="hidden" name="prj" id="gimBaPrj"></form>
        </div>
    </div>

    @section('scripts')
        @parent
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script src="{{ asset('gantt/libs/jquery/jquery.livequery.1.1.1.min.js') }}"></script>
        <script src="{{ asset('gantt/libs/jquery/jquery.timers.js') }}"></script>

        <script src="{{ asset('gantt/libs/utilities.js') }}"></script>
        <script src="{{ asset('gantt/libs/forms.js') }}"></script>
        <script src="{{ asset('gantt/libs/date.js') }}"></script>
        <script src="{{ asset('gantt/libs/dialogs.js') }}"></script>
        <script src="{{ asset('gantt/libs/layout.js') }}"></script>
        <script src="{{ asset('gantt/libs/i18nJs.js') }}"></script>
        <script src="{{ asset('gantt/libs/jquery/dateField/jquery.dateField.js') }}"></script>
        <script src="{{ asset('gantt/libs/jquery/JST/jquery.JST.js') }}"></script>
        <script src="{{ asset('gantt/libs/jquery/valueSlider/jquery.mb.slider.js') }}"></script>

        <script type="text/javascript" src="{{ asset('gantt/libs/jquery/svg/jquery.svg.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('gantt/libs/jquery/svg/jquery.svgdom.1.8.js') }}"></script>

        <script src="{{ asset('gantt/ganttUtilities.js') }}"></script>
        <script src="{{ asset('gantt/ganttTask.js') }}"></script>
        <script src="{{ asset('gantt/ganttDrawerSVG.js') }}"></script>
        <script src="{{ asset('gantt/ganttZoom.js') }}"></script>
        <script src="{{ asset('gantt/ganttGridEditor.js') }}"></script>
        <script src="{{ asset('gantt/ganttMaster.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
            integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
        </script>

        <script type="text/javascript">
            $(function() {
                //initProject();
            });

            var projectInitialized = false; // Variable para rastrear si el proyecto ya se ha inicializado

            function initProject() {
                // Verifica si el proyecto ya se ha inicializado antes
                if (!projectInitialized) {
                    var canWrite = true; //this is the default for test purposes
                    var urlSaveGanttOnServer = document.getElementById('workSpace').getAttribute('data-url-save');
                    var urlFolderAssigs = document.getElementById('workSpace').getAttribute('data-url-assigs');

                    // aquí comienza la inicialización de Gantt
                    window.ge = new GanttMaster(urlSaveGanttOnServer, urlFolderAssigs);
                    ge.set100OnClose = true;
                    ge.shrinkParent = true;
                    ge.init($("#workSpace"));
                    loadI18n(); // sobrescribe con los archivos localizados

                    // para forzar el cálculo del mejor nivel de zoom
                    delete ge.gantt.zoom;

                    var project = loadGanttFromServer();

                    if (!project.canWrite)
                        $(".ganttButtonBar button.requireWrite").attr("disabled", "true");

                    projectInitialized = true; // marca el proyecto como inicializado
                } else {
                    console.log("El proyecto ya ha sido inicializado.");
                }
            }

            function getDemoProject() {
                //console.debug("getDemoProject")
                ret = {
                    "tasks": [{
                        "id": -1,
                    }],
                    "canWrite": true,
                    "canDelete": true,
                    "canWriteOnParent": true,
                    canAdd: true
                }


                //actualize data
                var offset = new Date().getTime() - ret.tasks[0].start;
                for (var i = 0; i < ret.tasks.length; i++) {
                    ret.tasks[i].start = ret.tasks[i].start + offset;
                }
                return ret;
            }



            function loadGanttFromServer(taskId, callback) {

                //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
                var ret = loadFromLocalStorage();
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                    success: function(response) {
                        ge.loadProject(response);
                        ge.checkpoint(); //empty the undo stac
                    },
                    error: function(response) {
                        toastr.error(response);
                    }
                });
                return ret;
            }

            function upload(uploadedFile) {
                var fileread = new FileReader();

                fileread.onload = function(e) {
                    var content = e.target.result;
                    var intern = JSON.parse(content); // Array of Objects.
                    //console.log(intern); // You can index every object

                    ge.loadProject(intern);
                    ge.checkpoint(); //empty the undo stack

                };

                fileread.readAsText(uploadedFile);
            }

            function saveGanttOnServer() {

                //this is a simulation: save data to the local storage or to the textarea
                //saveInLocalStorage();
                var prj = ge.saveProject();
                if (!ge.urlSaveGanttOnServer) {
                    toastr.info('No has especificado una una URL para almacenar el proyecto');
                } else {
                    $.ajax({
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: ge.urlSaveGanttOnServer,
                        data: {
                            prj: JSON.stringify(prj)
                        },
                        success: function(response) {
                            if (response.success) {
                                var project = loadGanttFromServer(); //refrescar pantalla
                                if (!project.canWrite)
                                    $(".ganttButtonBar button.requireWrite").attr("disabled", "true");
                                Swal.fire({ //muestra el mensaje de guardado completo
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Tu proyecto ha sido guardado',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                if (document.getElementById('ultima_modificacion')) {
                                    var options = {
                                        weekday: 'long',
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    };
                                    var today = new Date();
                                    var date = today.toLocaleDateString("en-US");
                                    var time = today.toLocaleTimeString("en-US");
                                    document.getElementById('ultima_modificacion').innerHTML = date + ' ' + time;

                                } else {
                                    toastr.success('Guardado con éxito');
                                }
                            }
                            if (response.error) {
                                toastr.error('Ocurrio un error al guardar el cambio');
                            }
                        },
                        error: function(request, status, error) {
                            console.log(error);
                            toastr.error('Ocurrio un error al guardar: ' + request.responseText);
                        }
                    });
                }
            }

            function checkChangesGantt(vista) {
                var prj = ge.saveProject();
                var txt_prj = JSON.stringify(prj, null, '\t');
                $.ajax({
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.planTrabajoBase.checkChanges') }}",
                    data: {
                        txt_prj
                    },
                    success: function(response) {
                        if (response.existsChanges) {
                            let confirmacion = confirm(
                                'Existen cambios en Gantt que no han sido guardados, ¿Desea Guardarlos?');
                            if (confirmacion) {
                                saveGanttOnServer();
                                switch (vista) {
                                    case 'Gantt':
                                        loadGanttFromServer();
                                        break;
                                    case 'Tabla':
                                        initTable();
                                        break;
                                    case 'Calendario':
                                        initCalendar();
                                        break;
                                    case 'Kanban':
                                        initKanban();
                                        break;
                                    default:
                                        loadGanttFromServer();
                                        break;
                                }
                                loadGanttFromServer();
                            } else {
                                loadGanttFromServer();
                            }
                        }
                        if (response.notExistsChanges) {
                            loadGanttFromServer();
                        }
                    }
                });
            }

            // Function to download data to a file
            function download(data, filename, type) {
                var file = new Blob([data], {
                    type: type
                });
                if (window.navigator.msSaveOrOpenBlob) // IE10+
                    window.navigator.msSaveOrOpenBlob(file, filename);
                else { // Others
                    var a = document.createElement("a"),
                        url = URL.createObjectURL(file);
                    a.href = url;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    setTimeout(function() {
                        document.body.removeChild(a);
                        window.URL.revokeObjectURL(url);
                    }, 0);
                }
            }

            function newProject() {
                clearGantt();
            }


            function clearGantt() {
                ge.reset();
            }

            //-------------------------------------------  Get project file as JSON (used for migrate project from gantt to Teamwork) ------------------------------------------------------
            function getFile() {
                $("#gimBaPrj").val(JSON.stringify(ge.saveProject()));
                $("#gimmeBack").submit();
                $("#gimBaPrj").val("");

                /*  var uriContent = "data:text/html;charset=utf-8," + encodeURIComponent(JSON.stringify(prj));
                 neww=window.open(uriContent,"dl");*/
            }


            function loadFromLocalStorage() {
                var ret;
                if (localStorage) {
                    if (localStorage.getItem("teamworkGantDemo")) {
                        ret = localStorage.getItem("teamworkGantDemo");
                    }
                }

                //if not found create a new example task
                if (!ret || !ret.tasks || ret.tasks.length == 0) {
                    ret = getDemoProject();
                }
                return ret;
            }


            function saveInLocalStorage() {
                var prj = ge.saveProject();

                if (localStorage) {
                    localStorage.setItem("teamworkGantDemo", prj);
                }
            }

            function editResources() {

                //make resource editor
                var resourceEditor = $.JST.createFromTemplate({}, "RESOURCE_EDITOR");
                var resTbl = resourceEditor.find("#resourcesTable");

                for (var i = 0; i < ge.resources.length; i++) {
                    var res = ge.resources[i];
                    resTbl.append($.JST.createFromTemplate(res, "RESOURCE_ROW"))
                }


                //bind add resource
                resourceEditor.find("#addResource").click(function() {
                    resTbl.append($.JST.createFromTemplate({
                        id: "new",
                        name: "resource"
                    }, "RESOURCE_ROW"))
                });

                //bind save event
                resourceEditor.find("#resSaveButton").click(function() {
                    var newRes = [];
                    //find for deleted res
                    for (var i = 0; i < ge.resources.length; i++) {
                        var res = ge.resources[i];
                        var row = resourceEditor.find("[resId=" + res.id + "]");
                        if (row.length > 0) {
                            //if still there save it
                            var name = row.find("input[name]").val();
                            if (name && name != "")
                                res.name = name;
                            newRes.push(res);
                        } else {
                            //remove assignments
                            for (var j = 0; j < ge.tasks.length; j++) {
                                var task = ge.tasks[j];
                                var newAss = [];
                                for (var k = 0; k < task.assigs.length; k++) {
                                    var ass = task.assigs[k];
                                    if (ass.resourceId != res.id)
                                        newAss.push(ass);
                                }
                                task.assigs = newAss;
                            }
                        }
                    }

                    //loop on new rows
                    var cnt = 0
                    resourceEditor.find("[resId=new]").each(function() {
                        cnt++;
                        var row = $(this);
                        var name = row.find("input[name]").val();
                        if (name && name != "")
                            newRes.push(new Resource("tmp_" + new Date().getTime() + "_" + cnt, name));
                    });

                    ge.resources = newRes;

                    closeBlackPopup();
                    ge.redraw();
                });


                var ndo = createModalPopup(400, 500).append(resourceEditor);
            }

            function initializeHistoryManagement(taskId) {

                //retrieve from server the list of history points in millisecond that represent the instant when the data has been recorded
                //response: {ok:true, historyPoints: [1498168800000, 1498600800000, 1498687200000, 1501538400000, …]}
                $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {
                    CM: "GETGANTTHISTPOINTS",
                    OBJID: taskId
                }, function(response) {

                    //if there are history points
                    if (response.ok == true && response.historyPoints && response.historyPoints.length > 0) {

                        //add show slider button on button bar
                        var histBtn = $("<button>").addClass("button textual icon lreq30 lreqLabel").attr("title",
                            "SHOW_HISTORY").append("<span class=\"teamworkIcon\">&#x60;</span>");

                        //clicking it
                        histBtn.click(function() {
                            var el = $(this);
                            var ganttButtons = $(".ganttButtonBar .buttons");

                            //is it already on?
                            if (!ge.element.is(".historyOn")) {
                                ge.element.addClass("historyOn");
                                ganttButtons.find(".requireCanWrite").hide();

                                //load the history points from server again
                                showSavingMessage();
                                $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {
                                    CM: "GETGANTTHISTPOINTS",
                                    OBJID: ge.tasks[0].id
                                }, function(response) {
                                    jsonResponseHandling(response);
                                    hideSavingMessage();
                                    if (response.ok == true) {
                                        var dh = response.historyPoints;
                                        if (dh && dh.length > 0) {
                                            //si crea il div per lo slider
                                            var sliderDiv = $("<div>").prop("id", "slider").addClass(
                                                "lreq30 lreqHide").css({
                                                "display": "inline-block",
                                                "width": "500px"
                                            });
                                            ganttButtons.append(sliderDiv);

                                            var minVal = 0;
                                            var maxVal = dh.length - 1;

                                            $("#slider").show().mbSlider({
                                                rangeColor: '#2f97c6',
                                                minVal: minVal,
                                                maxVal: maxVal,
                                                startAt: maxVal,
                                                showVal: false,
                                                grid: 1,
                                                formatValue: function(val) {
                                                    return new Date(dh[val]).format();
                                                },
                                                onSlideLoad: function(obj) {
                                                    this.onStop(obj);

                                                },
                                                onStart: function(obj) {},
                                                onStop: function(obj) {
                                                    var val = $(obj).mbgetVal();
                                                    showSavingMessage();
                                                    /**
                                                     * load the data history for that milliseconf from server
                                                     * response in this format {ok: true, baselines: {...}}
                                                     *
                                                     * baselines: {61707: {duration:1,endDate:1550271599998,id:61707,progress:40,startDate:1550185200000,status:"STATUS_WAITING",taskId:"3055"},
                                                     *            {taskId:{duration:in days,endDate:in millis,id:history record id,progress:in percent,startDate:in millis,status:task status,taskId:"3055"}....}}                     */

                                                    $.getJSON(contextPath +
                                                        "/applications/teamwork/task/taskAjaxController.jsp", {
                                                            CM: "GETGANTTHISTORYAT",
                                                            OBJID: ge.tasks[0].id,
                                                            millis: dh[val]
                                                        },
                                                        function(response) {
                                                            jsonResponseHandling(
                                                                response);
                                                            hideSavingMessage();
                                                            if (response.ok) {
                                                                ge.baselines = response
                                                                    .baselines;
                                                                ge.showBaselines = true;
                                                                ge.baselineMillis = dh[
                                                                    val];
                                                                ge.redraw();
                                                            }
                                                        })

                                                },
                                                onSlide: function(obj) {
                                                    clearTimeout(obj.renderHistory);
                                                    var self = this;
                                                    obj.renderHistory = setTimeout(
                                                        function() {
                                                            self.onStop(obj);
                                                        }, 200)

                                                }
                                            });
                                        }
                                    }
                                });
                                // closing the history
                            } else {
                                //remove the slider
                                $("#slider").remove();
                                ge.element.removeClass("historyOn");
                                if (ge.permissions.canWrite)
                                    ganttButtons.find(".requireCanWrite").show();

                                ge.showBaselines = false;
                                ge.baselineMillis = undefined;
                                ge.redraw();
                            }

                        });
                        $("#saveGanttButton").before(histBtn);
                    }
                })
            }

            function showBaselineInfo(event, element) {
                //alert(element.attr("data-label"));
                $(element).showBalloon(event, $(element).attr("data-label"));
                ge.splitter.secondBox.one("scroll", function() {
                    $(element).hideBalloon();
                })
            }
        </script>

        <div id="gantEditorTemplates" style="display:none;">
            <div class="__template__" type="GANTBUTTONS">
                <!-- @include('admin.workPlan.diagramas-implementacion.code-coment-gantt.ganttButtonBar') -->
            </div>

            <div class="__template__" type="TASKSEDITHEAD">
                <!-- @include('admin.workPlan.diagramas-implementacion.code-coment-gantt.gdfTable') -->
            </div>

            <div class="__template__" type="TASKROW">
                <!-- @include('admin.workPlan.diagramas-implementacion.code-coment-gantt.type-taskrow') -->
            </div>

            <div class="__template__" type="TASKEMPTYROW">
                <!-- @include('admin.workPlan.diagramas-implementacion.code-coment-gantt.taskEditRow') -->
            </div>

            <div class="__template__" type="TASKBAR">
                <!-- @include('admin.workPlan.diagramas-implementacion.code-coment-gantt.taskBox') -->
            </div>
            <div class="__template__" type="CHANGE_STATUS">
                <!-- @include('admin.workPlan.diagramas-implementacion.code-coment-gantt.taskStatusBox') -->

            </div>

            <div class="__template__" type="TASK_EDITOR">
                {{-- <!-- --}}
                <div class="ganttTaskEditor">
                    <h2 class="taskData">Tarea</h2>
                    <table cellspacing="1" cellpadding="5" width="100%" class="table taskData" border="0">
                        <tr>
                            <td colspan="3" valign="top" style="padding-top: 50px;">
                                <div class="form-group anima-focus">
                                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                                        required="true">
                                    <label for="name"> Nombre <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group anima-focus">
                                    <textarea name="description" id="description" class="form-control" placeholder=""></textarea>
                                    <label for="description">Descripción</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="dateRow">
                            <td nowrap="">
                                <div class="form-group anima-focus">
                                    <input type="date" min="1945-01-01" class="form-control" id="start"
                                        name="start" autocomplete="off">
                                    <label for="inicio"> Inicio <span class="text-danger">*</span></label>
                                    <small class="p-0 m-0 text-xs error_inicio errores text-danger"></small>
                                </div>
                            </td>
                            <td nowrap="">
                                <div class="form-group anima-focus">
                                    <input type="date" min="1945-01-01" class="form-control" id="end"
                                        name="end" autocomplete="off">
                                    <label for="end"> Fin <span class="text-danger">*</span></label>
                                    <small class="p-0 m-0 text-xs error_fin errores text-danger"></small>
                                </div>
                            </td>
                            <td nowrap="">
                                <div class="form-group anima-focus">
                                    <input type="text" class="form-control" id="duration" name="duration" placeholder=""
                                        style="text-align: center;pointer-events: none;">
                                    <label for="duration"> Dias <span class="text-danger">*</span></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="status" class="">Estatus</label><br>
                                <select readonly style="color:black; text-align:center" id="status" name="status"
                                    class="taskStatus" status="(#=obj.status#)"
                                    onchange="$(this).attr('STATUS',$(this).val());">
                                    <option value="STATUS_ACTIVE" class="taskStatus" status="STATUS_ACTIVE">En Proceso
                                    </option>
                                    <option value="STATUS_SUSPENDED" class="taskStatus" status="STATUS_SUSPENDED">
                                        Suspendida</option>
                                    <option value="STATUS_DONE" class="taskStatus" status="STATUS_DONE">Completada
                                    </option>
                                    <option value="STATUS_FAILED" class="taskStatus" status="STATUS_FAILED">Con Retraso
                                    </option>
                                    <option value="STATUS_UNDEFINED" class="taskStatus" status="STATUS_UNDEFINED">Sin
                                        Iniciar</option>
                                </select>

                                {{-- <div class="taskDivStatus" status="(#=obj.status#)" >(#=obj.status#)</div> --}}
                            </td>
                        </tr>
                    </table>

                    <h2>Asignaciones</h2>
                    <table cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
                        <tr style="background-color: #FFEEEE;">
                            <th style="width:100px;">Nombre</th>
                            <th style="width:70px;">Rol</th>
                            <th style="width:5px;">Tiempo Aproxiamdo</th>
                            <th style="width:5px;"></th>
                        </tr>
                    </table>
                    <div id="addAssig"><span class="teamworkIcon" style="cursor: pointer">+</span></div>

                    <div style="text-align: right; padding-top: 20px">
                        <span id="saveButton" class="btn btn-xs btn-primary"
                            onClick="$(this).trigger('saveFullEditor.gantt');">Guardar</span>
                    </div>

                </div>
                {{-- --> --}}
            </div>
            <div class="__template__" type="ASSIGNMENT_ROW">
                <!--
                                                                                                                                                                                    <tr taskId="(#=obj.task.id#)" assId="(#=obj.assig.id#)" class="assigEditRow" >
                                                                                                                                                                                    <td ><select name="resourceId"  class="formElements" (#=obj.assig.id.indexOf("tmp_")==0?"":"disabled"#) ></select></td>
                                                                                                                                                                                    <td ><select type="select" name="roleId"  class="formElements"></select></td>
                                                                                                                                                                                    <td ><input type="text" name="effort" value="(#=getMillisInHoursMinutes(obj.assig.effort)#)" size="5" class="formElements"></td>
                                                                                                                                                                                    <td align="center"><span class="teamworkIcon delAssig del" style="cursor: pointer">d</span></td>
                                                                                                                                                                                    </tr>
                                                                                                                                                                                    -->
            </div>
            <div class="__template__" type="RESOURCE_EDITOR">
                {{-- <!-- --}}
                <div class="resourceEditor" style="padding: 5px;">

                    <h2>Equipos</h2>
                    <table cellspacing="1" cellpadding="0" width="100%" id="resourcesTable">
                        <tr>
                            <th style="width:100px;">Nombre</th>
                            <th style="width:50px;" id="addResource"><span class="teamworkIcon"
                                    style="cursor: pointer">+</span></th>
                        </tr>
                    </table>

                    <div style="text-align: right; padding-top: 20px"><button id="resSaveButton"
                            class="button big">Guardar</button></div>
                </div>
                {{-- --> --}}
            </div>
            <div class="__template__" type="RESOURCE_ROW">
                {{-- <!-- --}}
                <tr resId="(#=obj.id#)" class="resRow">
                    <td><input type="text" name="name" value="(#=obj.name#)" style="width:100%;"
                            class="formElements"></td>
                    <td align="center"><span class="teamworkIcon delRes del" style="cursor: pointer">d</span></td>
                </tr>
                {{-- --> --}}
            </div>
        </div>



        <script type="text/javascript">
            $.JST.loadDecorator("RESOURCE_ROW", function(resTr, res) {
                resTr.find(".delRes").click(function() {
                    $(this).closest("tr").remove()
                });
            });

            $.JST.loadDecorator("ASSIGNMENT_ROW", function(assigTr, taskAssig) {
                var resEl = assigTr.find("[name=resourceId]");

                var opt = $("<option>");

                resEl.append(opt);

                for (var i = 0; i < taskAssig.task.master.resources.length; i++) {

                    var res = taskAssig.task.master.resources[i];

                    opt = $("<option>");

                    opt.val(res.id).html(res.name);

                    if (taskAssig.assig.resourceId == res.id)

                        opt.attr("selected", "true");

                    resEl.append(opt);

                }
                var roleEl = assigTr.find("[name=roleId]");
                for (var i = 0; i < taskAssig.task.master.roles.length; i++) {
                    var role = taskAssig.task.master.roles[i];
                    var optr = $("<option>");
                    optr.val(role.id).html(role.name);
                    if (taskAssig.assig.roleId == role.id)
                        optr.attr("selected", "true");
                    roleEl.append(optr);
                }

                if (taskAssig.task.master.permissions.canWrite && taskAssig.task.canWrite) {
                    assigTr.find(".delAssig").click(function() {
                        var tr = $(this).closest("[assId]").fadeOut(200, function() {
                            $(this).remove()
                        });
                    });
                }

            });


            function loadI18n() {
                GanttMaster.messages = {
                    "CANNOT_WRITE": "No permission to change the following task:",
                    "CHANGE_OUT_OF_SCOPE": "Project update not possible as you lack rights for updating a parent project.",
                    "START_IS_MILESTONE": "Start date is a milestone.",
                    "END_IS_MILESTONE": "End date is a milestone.",
                    "TASK_HAS_CONSTRAINTS": "Task has constraints.",
                    "GANTT_ERROR_DEPENDS_ON_OPEN_TASK": "Error: there is a dependency on an open task.",
                    "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK": "Error: due to a descendant of a closed task.",
                    "TASK_HAS_EXTERNAL_DEPS": "This task has external dependencies.",
                    "GANNT_ERROR_LOADING_DATA_TASK_REMOVED": "GANNT_ERROR_LOADING_DATA_TASK_REMOVED",
                    "CIRCULAR_REFERENCE": "Circular reference.",
                    "CANNOT_DEPENDS_ON_ANCESTORS": "Cannot depend on ancestors.",
                    "INVALID_DATE_FORMAT": "The data inserted are invalid for the field format.",
                    "GANTT_ERROR_LOADING_DATA_TASK_REMOVED": "An error has occurred while loading the data. A task has been trashed.",
                    "CANNOT_CLOSE_TASK_IF_OPEN_ISSUE": "Cannot close a task with open issues",
                    "TASK_MOVE_INCONSISTENT_LEVEL": "You cannot exchange tasks of different depth.",
                    "CANNOT_MOVE_TASK": "CANNOT_MOVE_TASK",
                    "PLEASE_SAVE_PROJECT": "PLEASE_SAVE_PROJECT",
                    "GANTT_SEMESTER": "Semester",
                    "GANTT_SEMESTER_SHORT": "s.",
                    "GANTT_QUARTER": "Quarter",
                    "GANTT_QUARTER_SHORT": "q.",
                    "GANTT_WEEK": "Week",
                    "GANTT_WEEK_SHORT": "w."
                };
            }



            function createNewResource(el) {
                var row = el.closest("tr[taskid]");
                var name = row.find("[name=resourceId_txt]").val();
                var url = contextPath + "/applications/teamwork/resource/resourceNew.jsp?CM=ADD&name=" + encodeURI(name);

                openBlackPopup(url, 700, 320, function(response) {
                    //fillare lo smart combo
                    if (response && response.resId && response.resName) {
                        //fillare lo smart combo e chiudere l'editor
                        row.find("[name=resourceId]").val(response.resId);
                        row.find("[name=resourceId_txt]").val(response.resName).focus().blur();
                    }

                });
            }

            $(document).on("change", "#load-file", function() {
                var uploadedFile = $("#load-file").prop("files")[0];
                upload(uploadedFile);
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const cards = document.querySelectorAll(".item");
                const indicatorsContainer = document.querySelector(".indicators");
                let currentCardIndex = 0;

                // Crea indicadores
                for (let i = 0; i < cards.length; i++) {
                    const indicator = document.createElement("div");
                    indicator.classList.add("indicator");
                    indicatorsContainer.appendChild(indicator);
                }
                const indicators = document.querySelectorAll(".indicator");

                // Muestra la primera card y el indicador activo
                showCard(currentCardIndex);

                // Función para mostrar una card específica
                function showCard(index) {
                    // Oculta todas las cards y desactiva todos los indicadores
                    cards.forEach((card) => card.classList.remove("active"));
                    indicators.forEach((indicator) => indicator.classList.remove("active"));

                    // Muestra la card actual y activa el indicador correspondiente
                    cards[index].classList.add("active");
                    indicators[index].classList.add("active");

                    // Desactiva el botón "Anterior" cuando estamos en el primer indicador
                    document.querySelector(".prev-btn").disabled = index === 0;

                    // Si llegamos al último indicador, cambia el texto del botón de "Siguiente" a "Finalizar"
                    const nextBtn = document.querySelector(".next-btn");
                    nextBtn.textContent = index === cards.length - 1 ? "Finalizar" : "Siguiente \u25B9";

                    // Actualiza el índice actual
                    currentCardIndex = index;
                }

                // Evento para el botón de siguiente
                document.querySelector(".next-btn").addEventListener("click", function() {
                    if (currentCardIndex === cards.length - 1) {
                        // Abre el modal cuando se hace clic en "Finalizar"
                        $('#modalTutorial').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        resetCardsAndIndicators();
                    } else {
                        currentCardIndex++;
                        showCard(currentCardIndex);
                    }
                });

                // Evento para el botón de anterior
                document.querySelector(".prev-btn").addEventListener("click", function() {
                    if (currentCardIndex > 0) {
                        currentCardIndex--;
                        showCard(currentCardIndex);
                    }
                });

                // Eventos para los indicadores
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener("click", function() {
                        showCard(index);
                    });
                });

                // Cierra el modal cuando se hace clic en la "x"
                document.querySelector(".close").addEventListener("click", function() {
                    $('#modalTutorial').modal('hide');
                    resetCardsAndIndicators();
                });

                // Cierra el modal cuando se hace clic fuera del contenido del modal
                window.onclick = function(event) {
                    if (event.target == document.getElementById("modalTutorial")) {
                        $('#modalTutorial').modal('hide');
                        resetCardsAndIndicators();
                    }
                };

                function resetCardsAndIndicators() {
                    currentCardIndex = 0;
                    showCard(currentCardIndex);
                }
            });
        </script>
    @endsection
    <style>
        .slider-container {
            width: 100%;
            position: relative;
        }

        .cards-wrapper {
            display: flex;
            overflow-x: hidden;
            align-items: center;
        }

        .item {
            width: 100%;
            flex: 0 0 auto;
            background: transparent;
            border-radius: 8px;
            margin-right: 10px;
            justify-content: center;
            display: none;
        }

        .item.active {
            display: flex;
        }

        .indicators {
            text-align: center;
            margin-top: 10px;
        }

        .indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: #818181;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .indicator.active {
            background: #467BD3;
        }

        .indicator.visited {
            background: #467BD3;
        }

        .next-btn {
            font-size: 16px;
            background-color: transparent;
            color: #467BD3;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: auto;
            padding-right: 50px;
        }

        .prev-btn {
            font-size: 16px;
            background-color: transparent;
            color: #467BD3;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: auto;
            padding-left: 50px;
        }

        .titleGrantTutorial {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #467BD3;
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .contentItem {
            width: 350px;
            height: 367px;
            border: none !important;

        }

        .card-text {
            color: #575757;
            font-size: 14px;
        }

        .pulse {
            animation: pulse-animation 2s infinite;
        }

        @keyframes pulse-animation {
            0% {
                box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
            }

            100% {
                box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
            }
        }
    </style>
    {{-- modal de instrucciones --}}
    <div class="modal fade" id="modalTutorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 440px;height: 575px;border-radius: 20px;">
                <div class="modal-body">
                    <div class="slider-container">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="indicators"></div>
                        <div class="titleGrantTutorial">Tutorial</div>
                        <div class="cards-wrapper">
                            <div class="item active">
                                <div class="card contentItem">
                                    <div class="card-body">
                                        <p class="card-text">Para iniciar con este proceso debemos seleccionar la
                                            opción “Gantt” la cual se encuentra en la parte superior derecha de la
                                            pantalla.</p>
                                        <p class="card-text">En la parte inferior izquierda de la pantalla se
                                            encuentran una serie de botones, los cuales están ordenados de la siguiente
                                            forma</p>

                                        <li class="card-text" style="list-style-type: none;">1.Rehacer, Deshacer</li>
                                        <li class="card-text" style="list-style-type: none;">2.Insertar arriba,
                                            Insertar abajo</li>
                                        <li class="card-text" style="list-style-type: none;">3.Quitar indentación,
                                            Indentar</li>
                                        <li class="card-text" style="list-style-type: none;">4.Mover hacia arriba,
                                            Mover hacia abajo</li>
                                        <li class="card-text" style="list-style-type: none;">5.Eliminar</li>
                                        <li class="card-text" style="list-style-type: none;">6.Incrementar Zoom,
                                            Decrementar Zoom</li>
                                        <li class="card-text" style="list-style-type: none;">7.Posicionar a la
                                            izquierda, en medio y a la derecha</li>
                                        <li class="card-text" style="list-style-type: none;">8.Guardar cambios.</li>

                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card contentItem">
                                    <div class="card-body">
                                        <p class="card-text">Para aumentar o disminuir el zoom en el apartado, debemos
                                            seleccionar los siguientes botónes.</p>
                                        <i class="material-symbols-outlined">zoom_in</i>
                                        <i class="material-symbols-outlined">zoom_out</i>
                                        <hr>
                                        <p class="card-text">Para guardar los cambios realizados en el apartado,
                                            debemos seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined">save</i>
                                        <hr>
                                        <p class="card-text">Para posicionar la pantalla a la izquierda, centro o
                                            derecha, debemos seleccionar los siguientes botones.</p>
                                        <i class="teamworkIcon"
                                            style="color: #818181 !important;font-size: 20px !important;">F</i>
                                        <i class="teamworkIcon"
                                            style="color: #818181 !important;font-size: 20px !important;">O</i>
                                        <i class="teamworkIcon"
                                            style="color: #818181 !important;font-size: 20px !important;">R</i>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card contentItem">
                                    <div class="card-body">
                                        <p class="card-text">Para identar una tarea en el apartado, debemos seleccionar
                                            el siguiente botón.</p>
                                        <i class="material-symbols-outlined"> arrow_left_alt</i>
                                        <i class="material-symbols-outlined"> arrow_right_alt</i>
                                        <hr>
                                        <p class="card-text">Para mover una tarea hacia arriba o hacia abajo en el
                                            apartado, debemos seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined">north</i>
                                        <i class="material-symbols-outlined">south</i>
                                        <hr>
                                        <p class="card-text">Para eliminar una tarea en el apartado, debemos
                                            seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined">delete</i>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card contentItem">
                                    <div class="card-body">
                                        <p class="card-text">Para insertar una tarea debajo de la fila, debemos
                                            seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined">keyboard_capslock</i>
                                        <hr>
                                        <p class="card-text">Para quitar una identación en una tarea en el apartado,
                                            debemos seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined"> arrow_left_alt</i>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card contentItem">
                                    <div class="card-body">
                                        <p class="card-text">Para deshacer una acción realizada en el apartado, debemos
                                            seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined"
                                            style="transform:rotateY(190deg);">prompt_suggestion </i>
                                        <hr>
                                        <p class="card-text">Para rehacer una acción realizada en el apartado, debemos
                                            seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined">prompt_suggestion </i>
                                        <hr>
                                        <p class="card-text">Para insertar una tarea hacia arriba de la fila, debemos
                                            seleccionar el siguiente botón.</p>
                                        <i class="material-symbols-outlined"
                                            style="transform: rotateX(190deg)">keyboard_capslock</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display:flex;">
                            <button class="prev-btn">&#10094; Anterior</button>
                            <button class="next-btn">Siguiente &#10095;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
