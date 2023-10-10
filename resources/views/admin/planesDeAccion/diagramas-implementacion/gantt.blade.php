<div id="sistema_gantt">
    <p>
        Se deberán guardar los cambios realizados presionando el icono "Guardar"
    </p>


    <link rel=stylesheet href="{{ asset('gantt/platform.css') }}" type="text/css">
    <link rel=stylesheet href="{{ asset('gantt/libs/jquery/dateField/jquery.dateField.css') }}" type="text/css">

    <link rel=stylesheet href="{{ asset('gantt/gantt.css') }}" type="text/css">
    <link rel=stylesheet href="{{ asset('gantt/ganttPrint.css') }}" type="text/css" media="print">
    <link rel=stylesheet href="{{ asset('gantt/libs/jquery/valueSlider/mb.slider.css') }}" type="text/css"
        media="print">

    <div id="ndo"
        style="position:absolute;right:5px;top:5px;width:378px;padding:5px;background-color: #FFF5E6; border:1px solid #F9A22F; font-size:12px; display: none;"
        class="noprint">
        This Gantt editor is free thanks to <a href="http://twproject.com" target="_blank">Twproject</a> where it can be
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

@section('scripts')

    @parent
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
        var ge;
        $(function() {
            initProject();
        });

        function initProject() {
            var canWrite = true; //this is the default for test purposes
            var urlSaveGanttOnServer = document.getElementById('workSpace').getAttribute('data-url-save');
            var urlFolderAssigs = document.getElementById('workSpace').getAttribute('data-url-assigs');

            // here starts gantt initialization
            window.ge = new GanttMaster(urlSaveGanttOnServer, urlFolderAssigs);
            ge.set100OnClose = true;

            ge.shrinkParent = true;

            ge.init($("#workSpace"));
            loadI18n(); //overwrite with localized ones

            //in order to force compute the best-fitting zoom level
            delete ge.gantt.zoom;

            var project = loadGanttFromServer();

            if (!project.canWrite)
                $(".ganttButtonBar button.requireWrite").attr("disabled", "true");
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
                    document.getElementById("ultima_modificacion").innerHTML=moment(response.updated_at).format("DD-MM-YYYY hh:mm:ss A")
                    ge.checkpoint(); //empty the undo stac
                },
                error: function(response) {
                    toastr.error(response);
                    // setTimeout(() => {
                    //     toastr.info("Reiniciaremos el diagrama de gantt");
                    //     window.location.reload();
                    // }, 1000);
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
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.planes-de-accion.saveProject', $planImplementacion) }}",
                data: {
                    prj
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Tu proyecto ha sido guardado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo ocasionó un error!',

                        })
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${error}`,

                    })
                }

            });
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
                            // loadGanttFromServer();
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


        //-------------------------------------------  Open a black popup for managing resources. This is only an axample of implementation (usually resources come from server) ------------------------------------------------------

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
            <!--
                                                            <div class="ganttButtonBar noprint">
                                                            <div class="buttons">
                                                            <a href="https://gantt.twproject.com/"><img src="{{ asset('gantt/res/twGanttLogo.png') }}" alt="Twproject" align="absmiddle" style="max-width: 136px; padding-right: 15p; display: none;x"></a>

                                                            <button onclick="$('#workSpace').trigger('undo.gantt');return false;" class="button textual icon requireCanWrite" title="Deshacer"><span class="teamworkIcon">&#39;</span></button>
                                                            <button onclick="$('#workSpace').trigger('redo.gantt');return false;" class="button textual icon requireCanWrite" title="Rehacer"><span class="teamworkIcon">&middot;</span></button>
                                                            <span class="ganttButtonSeparator requireCanWrite requireCanAdd"></span>
                                                            <button onclick="$('#workSpace').trigger('addAboveCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="Insertar arriba"><span class="teamworkIcon">l</span></button>
                                                            <button onclick="$('#workSpace').trigger('addBelowCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="Insertar debajo"><span class="teamworkIcon">X</span></button>
                                                            <span class="ganttButtonSeparator requireCanWrite requireCanInOutdent"></span>
                                                            <button onclick="$('#workSpace').trigger('outdentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="Quitar indentación"><span class="teamworkIcon">.</span></button>
                                                            <button onclick="$('#workSpace').trigger('indentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="Indentar"><span class="teamworkIcon">:</span></button>
                                                            <span class="ganttButtonSeparator requireCanWrite requireCanMoveUpDown"></span>
                                                            <button onclick="$('#workSpace').trigger('moveUpCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="Mover hacia arriba"><span class="teamworkIcon">k</span></button>
                                                            <button onclick="$('#workSpace').trigger('moveDownCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="Mover hacia bajo"><span class="teamworkIcon">j</span></button>
                                                            <span class="ganttButtonSeparator requireCanWrite requireCanDelete"></span>
                                                            <button onclick="$('#workSpace').trigger('deleteFocused.gantt');return false;" class="button textual icon delete requireCanWrite" title="Elimina"><span class="teamworkIcon">&cent;</span></button>
                                                            <span class="ganttButtonSeparator"></span>
                                                            <button onclick="$('#workSpace').trigger('expandAll.gantt');return false;" class="button textual icon " title="Expandir"><span class="teamworkIcon">6</span></button>
                                                            <button onclick="$('#workSpace').trigger('collapseAll.gantt'); return false;" class="button textual icon " title="Colapsar"><span class="teamworkIcon">5</span></button>

                                                            <span class="ganttButtonSeparator"></span>
                                                            <button onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;" class="button textual icon " title="Decrementar Zoom"><span class="teamworkIcon">)</span></button>
                                                            <button onclick="$('#workSpace').trigger('zoomPlus.gantt');return false;" class="button textual icon " title="Incrementar Zoom"><span class="teamworkIcon">(</span></button>
                                                            <span class="ganttButtonSeparator"></span>
                                                            <button onclick="$('#workSpace').trigger('print.gantt');return false;" class="button textual icon " title="Imprimir"><span class="teamworkIcon">p</span></button>
                                                            <span class="ganttButtonSeparator"></span>
                                                            <button onclick="ge.gantt.showCriticalPath=!ge.gantt.showCriticalPath; ge.redraw();return false;" class="button textual icon requireCanSeeCriticalPath" title="Ruta crítica"><span class="teamworkIcon">&pound;</span></button>
                                                            <span class="ganttButtonSeparator requireCanSeeCriticalPath"></span>
                                                            <button onclick="ge.splitter.resize(.1);return false;" class="button textual icon" ><span class="teamworkIcon">F</span></button>
                                                            <button onclick="ge.splitter.resize(50);return false;" class="button textual icon" ><span class="teamworkIcon">O</span></button>
                                                            <button onclick="ge.splitter.resize(100);return false;" class="button textual icon"><span class="teamworkIcon">R</span></button>
                                                            <span class="ganttButtonSeparator"></span>
                                                            <button onclick="ge.element.toggleClass('colorByStatus' );return false;" class="button textual icon"><span class="teamworkIcon">&sect;</span></button>
                                                            <button class="button textual requireWrite" title="Editar recursos"><a href="{{ route('admin.empleados.index') }}"><span class="teamworkIcon">M</span></a></button>
                                                            &nbsp; &nbsp; &nbsp; &nbsp;
                                                            <button onclick="saveGanttOnServer();" class="button textual icon icons_propios_gantt guardar " title="Guardar"><i class="fas fa-save"></i></button>
                                                            <div class="ml-2 btn-group dropright">
                                                            </div>
                                                            </div>

                                                            <div>
                                                            <input type="file" name="load-file" id="load-file" style="display: none;">
                                                            <label for="load-file" style="display: none;">Load</label>
                                                            <button style="display: none;" onclick='newProject();' class='button requireWrite newproject'><em>clear project</em></button>
                                                            <button class="button login" title="login/enroll" onclick="loginEnroll($(this));" style="display:none;">login/enroll</button>
                                                            <button class="button opt collab" title="Start with Twproject" onclick="collaborate($(this));" style="display:none;"><em>collaborate</em></button>
                                                            </div>
                                                            <div class="mt-4">
                                                            <span><strong id="version_actual_gantt" style="text-transform:capitalize"></strong>
                                                            </div>
                                                            </div>
                                                            -->
        </div>

        <div class="__template__" type="TASKSEDITHEAD">
            <!--
                                                            <table class="gdfTable" cellspacing="0" cellpadding="0">
                                                            <thead>
                                                            <tr style="height:40px">
                                                            <th class="gdfColHeader gdfColHeaderNumber" style="width:35px; border-right: none"></th>
                                                            <th class="gdfColHeader" style="width:30px !important;"></th>
                                                            <th class="gdfColHeader gdfResizable gdfColHeaderName" style="width:300px;">Nombre</th>
                                                            <th class="gdfColHeader gdfColHeaderFirstCheck"  align="center" style="width:17px;" title="Fecha inicio como milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
                                                            <th class="gdfColHeader gdfResizable gdfColHeaderStartDate" style="width:80px;">Inicio</th>
                                                            <th class="gdfColHeader gdfColHeaderSecondCheck"  align="center" style="width:17px;" title="Fecha fin como milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
                                                            <th class="gdfColHeader gdfResizable gdfColHeaderEndDate" style="width:80px;">Finalización</th>
                                                            <th class="gdfColHeader gdfResizable gdfColHeaderDuration" style="width:50px;">Duración</th>
                                                            <th class="gdfColHeader gdfResizable gdfColHeaderProgress" style="width:20px;">%</th>
                                                            <th class="gdfColHeader gdfResizable requireCanSeeDep" style="width:50px;">Dependencias</th>
                                                            <th class="gdfColHeader gdfResizable gdfColHeaderAssigs" style="width:1000px; text-align: left; padding-left: 10px;">Asignaciones</th>
                                                            </tr>
                                                            </thead>
                                                            </table>
                                                            -->
        </div>

        <div class="__template__" type="TASKROW">
            <!--
                                                            <tr id="tid_(#=obj.id#)" taskId="(#=obj.id#)" class="taskEditRow (#=obj.isParent()?'isParent':''#) (#=obj.collapsed?'collapsed':''#)" level="(#=level#)">
                                                            <th class="gdfCell (#=level>1?'edit':''#)" align="right" style="cursor:pointer;"><span class="taskRowIndex">(#=obj.getRow()+1#)</span> <span class="teamworkIcon" style="font-size:12px;" >(#=level>1?'e':''#)</span></th>
                                                            <td class="gdfCell noClip" align="center"><div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div></td>
                                                            <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10+18#)px;">
                                                            <div class="exp-controller" align="center"></div>
                                                            <input type="text" name="name" value="(#=obj.name#)" placeholder="name">
                                                            </td>
                                                            <td class="gdfCell" align="center"><input type="checkbox" name="startIsMilestone"></td>
                                                            <td class="gdfCell"><input type="text" name="start"  value="" class="date"></td>
                                                            <td class="gdfCell" align="center"><input type="checkbox" name="endIsMilestone"></td>
                                                            <td class="gdfCell"><input type="text" name="end" value="" class="date"></td>
                                                            <td class="gdfCell"><input type="text" name="duration" autocomplete="off" value="(#=obj.duration#)"></td>
                                                            <td class="gdfCell"><input type="text" name="progress" class="validated" entrytype="PERCENTILE" autocomplete="off" value="(#=obj.progress?obj.progress:''#)" (#=obj.progressByWorklog?"readOnly":"readOnly"#)></td>
                                                            <td class="gdfCell requireCanSeeDep"><input type="text" name="depends" autocomplete="off" value="(#=obj.depends#)" (#=obj.hasExternalDep?"readonly":""#)></td>
                                                            <td class="gdfCell taskAssigs">(#=obj.getAssigsString()#)</td>
                                                            </tr>
                                                            -->
        </div>

        <div class="__template__" type="TASKEMPTYROW">
            <!--
                                                            <tr class="taskEditRow emptyRow" >
                                                            <th class="gdfCell" align="right"></th>
                                                            <td class="gdfCell noClip" align="center"></td>
                                                            <td class="gdfCell"></td>
                                                            <td class="gdfCell"></td>
                                                            <td class="gdfCell"></td>
                                                            <td class="gdfCell"></td>
                                                            <td class="gdfCell"></td>
                                                            <td class="gdfCell"></td>
                                                            <td class="gdfCell"></td>
                                                            <td class="gdfCell requireCanSeeDep"></td>
                                                            <td class="gdfCell"></td>
                                                            </tr>
                                                            -->
        </div>

        <div class="__template__" type="TASKBAR">
            <!--
                                                            <div class="taskBox taskBoxDiv" taskId="(#=obj.id#)" >
                                                            <div class="layout (#=obj.hasExternalDep?'extDep':''#)">
                                                            <div class="taskStatus" status="(#=obj.status#)"></div>
                                                            <div class="taskProgress" style="width:(#=obj.progress>100?100:obj.progress#)%; background-color:(#=obj.progress>100?'red':'rgb(153,255,51);'#);"></div>
                                                            <div class="milestone (#=obj.startIsMilestone?'active':''#)" ></div>

                                                            <div class="taskLabel"></div>
                                                            <div class="milestone end (#=obj.endIsMilestone?'active':''#)" ></div>
                                                            </div>
                                                            </div>
                                                            -->
        </div>


        <div class="__template__" type="CHANGE_STATUS">
            <!--
                                                            <div class="taskStatusBox">
                                                            {{-- <div class="taskStatus cvcColorSquare" status="STATUS_ACTIVE" title="En proceso"></div> --}}
                                                            {{-- <div class="taskStatus cvcColorSquare" status="STATUS_DONE" title="Completada"></div> --}}
                                                            {{-- <div class="taskStatus cvcColorSquare" status="STATUS_FAILED" title="Con retraso"></div> --}}
                                                            <div class="ml-3 taskStatus cvcColorSquare" status="STATUS_SUSPENDED" title="Suspendida"></div>
                                                            {{-- <div class="taskStatus cvcColorSquare" status="STATUS_WAITING" title="En espera" style="display: none;"></div> --}}
                                                            {{-- <div class="taskStatus cvcColorSquare" status="STATUS_UNDEFINED" title="Sin iniciar"></div> --}}
                                                            </div>
                                                            -->
        </div>




        <div class="__template__" type="TASK_EDITOR">
            <!--
                                                            <div class="ganttTaskEditor">
                                                            <h2 class="taskData">Tarea</h2>
                                                            <table  cellspacing="1" cellpadding="5" width="100%" class="table taskData" border="0">
                                                            <tr>
                                                            <td colspan="3" valign="top"><label for="name" class="required">Nombre</label><br><input type="text" name="name" id="name"class="formElements" autocomplete='off' maxlength=255 style='width:100%' value="" required="true" oldvalue="1"></td>
                                                            </tr>
                                                            <tr class="dateRow">
                                                            <td nowrap="">
                                                            <div style="position:relative">
                                                            <label for="start">Inicio</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="checkbox" id="startIsMilestone" name="startIsMilestone" value="yes"> &nbsp;<label for="startIsMilestone">del milestone</label>&nbsp;
                                                            <br><input type="text" name="start" id="start" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
                                                            <span title="calendar" id="starts_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>          </div>
                                                            </td>
                                                            <td nowrap="">
                                                            <label for="end">Fin</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="checkbox" id="endIsMilestone" name="endIsMilestone" value="yes"> &nbsp;<label for="endIsMilestone">del milestone</label>&nbsp;
                                                            <br><input type="text" name="end" id="end" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
                                                            <span title="calendar" id="ends_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>
                                                            </td>
                                                            <td nowrap="" >
                                                            <label for="duration" class="">Días</label><br>
                                                            <input type="text" name="duration" id="duration" size="4" class="formElements validated durationdays" title="Duration is in working days." autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DURATIONDAYS">&nbsp;
                                                            </td>
                                                            </tr>

                                                            <tr>
                                                             <td  colspan="2">
                                                        <label for="status" class="">Estatus</label><br>
                                                         <select readonly disabled style="color:black; text-align:center" id="status" name="status" class="taskStatus" status="(#=obj.status#)"  onchange="$(this).attr('STATUS',$(this).val());">
            <option value="STATUS_ACTIVE" class="taskStatus" status="STATUS_ACTIVE" >En Proceso</option>
            <option value="STATUS_WAITING" class="taskStatus" status="STATUS_WAITING" >En Espera</option>
            <option value="STATUS_SUSPENDED" class="taskStatus" status="STATUS_SUSPENDED" >Suspendida</option>
            <option value="STATUS_DONE" class="taskStatus" status="STATUS_DONE" >Completada</option>
            <option value="STATUS_FAILED" class="taskStatus" status="STATUS_FAILED" >Con Retraso</option>
            <option value="STATUS_UNDEFINED" class="taskStatus" status="STATUS_UNDEFINED" >Sin Iniciar</option>
            </select>


                                                        {{-- <div class="taskDivStatus" status="(#=obj.status#)" >(#=obj.status#)</div> --}}


                                                        </td>

                                                            <td valign="top" nowrap>
                                                            <label>Progreso(%)</label><br>
                                                            <input type="text" name="progress" id="progress" size="7" class="formElements validated percentile" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="PERCENTILE">
                                                            </td>
                                                            </tr>

                                                            </tr>
                                                            <tr>
                                                            <td colspan="4">
                                                            <label for="description">Descripción</label><br>
                                                            <textarea rows="3" cols="30" id="description" name="description" class="formElements" style="width:100%"></textarea>
                                                            </td>
                                                            </tr>
                                                            </table>

                                                            <h2>Asignaciones</h2>
                                                            <table  cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
                                                            <tr>
                                                            <th style="width:100px;">Nombre</th>
                                                            <th style="width:70px;">Rol</th>
                                                            <th style="width:30px;">est.wklg.</th>
                                                            <th style="width:30px;" id="addAssig"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
                                                            </tr>
                                                            </table>

                                                            <div style="text-align: right; padding-top: 20px">
                                                            <span id="saveButton" class="button first" onClick="$(this).trigger('saveFullEditor.gantt');">Guardar</span>
                                                            </div>

                                                            </div>
                                                            -->
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
            <!--
                                                            <div class="resourceEditor" style="padding: 5px;">

                                                            <h2>Equipos</h2>
                                                            <table  cellspacing="1" cellpadding="0" width="100%" id="resourcesTable">
                                                            <tr>
                                                            <th style="width:100px;">Nombre</th>
                                                            <th style="width:30px;" id="addResource"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
                                                            </tr>
                                                            </table>

                                                            <div style="text-align: right; padding-top: 20px"><button id="resSaveButton" class="button big">Guardar</button></div>
                                                            </div>
                                                            -->
        </div>



        <div class="__template__" type="RESOURCE_ROW">
            <!--
                                                            <tr resId="(#=obj.id#)" class="resRow" >
                                                            <td ><input type="text" name="name" value="(#=obj.name#)" style="width:100%;" class="formElements"></td>
                                                            <td align="center"><span class="teamworkIcon delRes del" style="cursor: pointer">d</span></td>
                                                            </tr>
                                                            -->
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









@endsection
