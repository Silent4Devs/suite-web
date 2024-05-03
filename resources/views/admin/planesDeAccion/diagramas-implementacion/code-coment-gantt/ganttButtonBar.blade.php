<div class="ganttButtonBar noprint">
    <div class="buttons">
        <div class="btn-optionn-head-first-gantt">
            <a href="https://gantt.twproject.com/">
                <img src="{{ asset('gantt/res/twGanttLogo.png') }}" alt="Twproject" align="absmiddle"
                    style="max-width: 136px; padding-right: 15p; display: none;x">
            </a>

            <button onclick="$('#workSpace').trigger('undo.gantt');return false;"
                class="button textual icon requireCanWrite" title="Deshacer">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined" style="transform:rotateY(190deg);">prompt_suggestion </i>
                </span>
            </button>
            <button onclick="$('#workSpace').trigger('redo.gantt');return false;"
                class="button textual icon requireCanWrite ml-3" title="Rehacer">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">prompt_suggestion </i>
                </span>
            </button>
            <span class="ganttButtonSeparator requireCanWrite requireCanAdd"></span>
            <button onclick="$('#workSpace').trigger('addAboveCurrentTask.gantt');return false;"
                class="button textual icon requireCanWrite requireCanAdd" title="Insertar arriba">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined" style="transform: rotateX(190deg)">keyboard_capslock</i>
                </span>
            </button>
            <button onclick="$('#workSpace').trigger('addBelowCurrentTask.gantt');return false;"
                class="button textual icon requireCanWrite requireCanAdd" title="Insertar debajo">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">keyboard_capslock</i>
                </span>
            </button>
            <span class="ganttButtonSeparator requireCanWrite requireCanInOutdent"></span>
            <button onclick="$('#workSpace').trigger('outdentCurrentTask.gantt');return false;"
                class="button textual icon requireCanWrite requireCanInOutdent" title="Quitar indentación">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined"> arrow_left_alt</i>
                </span>
            </button>
            <button onclick="$('#workSpace').trigger('indentCurrentTask.gantt');return false;"
                class="button textual icon requireCanWrite requireCanInOutdent" title="Indentar">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined"> arrow_right_alt</i>
                </span>
            </button>
            <span class="ganttButtonSeparator requireCanWrite requireCanMoveUpDown"></span>
            <button onclick="$('#workSpace').trigger('moveUpCurrentTask.gantt');return false;"
                class="button textual icon requireCanWrite requireCanMoveUpDown" title="Mover hacia arriba">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">north</i>
                </span>
            </button>
            <button onclick="$('#workSpace').trigger('moveDownCurrentTask.gantt');return false;"
                class="button textual icon requireCanWrite requireCanMoveUpDown" title="Mover hacia bajo">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">south</i>
                </span>
            </button>
            <span class="ganttButtonSeparator requireCanWrite requireCanDelete"></span>
            <button onclick="$('#workSpace').trigger('deleteFocused.gantt');return false;"
                class="button textual icon delete requireCanWrite" title="Elimina">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">delete</i>
                </span>
            </button>
            {{-- <span class="ganttButtonSeparator"></span>
            <button onclick="$('#workSpace').trigger('expandAll.gantt');return false;" class="button textual icon "
                title="Expandir">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">collapse_all</i>
                </span>
            </button>
            <button onclick="$('#workSpace').trigger('collapseAll.gantt'); return false;" class="button textual icon "
                title="Colapsar">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">expand_all</i>
                </span>
            </button> --}}
            <span class="ganttButtonSeparator"></span>
            <button onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;" class="button textual icon "
                title="Decrementar Zoom">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">zoom_in</i>
                </span>
            </button>
            <button onclick="$('#workSpace').trigger('zoomPlus.gantt');return false;" class="button textual icon "
                title="Incrementar Zoom">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">zoom_out</i>
                </span>
            </button>
            {{-- <span class="ganttButtonSeparator"></span>
            <button onclick="$('#workSpace').trigger('print.gantt');return false;" class="button textual icon "
                title="Imprimir">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">print</i>
                </span>
            </button> --}}
            {{-- <span class="ganttButtonSeparator"></span>
            <button onclick="ge.gantt.showCriticalPath=!ge.gantt.showCriticalPath; ge.redraw();return false;"
                class="button textual icon requireCanSeeCriticalPath" title="Ruta crítica">
                <span class="teamworkIcon">&pound;</span>
            </button> --}}
            <span class="ganttButtonSeparator requireCanSeeCriticalPath"></span>
            <button onclick="ge.splitter.resize(.1);return false;" class="button textual icon">
                <span class="teamworkIcon">F</span>
            </button>
            <button onclick="ge.splitter.resize(50);return false;" class="button textual icon">
                <span class="teamworkIcon">O</span>
            </button>
            <button onclick="ge.splitter.resize(100);return false;" class="button textual icon">
                <span class="teamworkIcon">R</span>
            </button>
            {{-- <span class="ganttButtonSeparator"></span>
            <button onclick="ge.element.toggleClass('colorByStatus' );return false;" class="button textual icon">
                <span class="teamworkIcon">
                    <i class="material-symbols-outlined">palette</i>
                </span>
            </button>
            <button class="button textual requireWrite" title="Editar recursos">
                <a href="{{ route('admin.empleados.index') }}">
                    <span class="teamworkIcon">M</span>
                </a>
            </button> --}}

            <button onclick="saveGanttOnServer();"
                class="btn btn-outline-primary textual icon icons_propios_gantt guardar ml-5" title="Guardar"
                style="padding: 10px !important; background-color: #E9F9FF; color: #006DDB !important;">
                <i class="material-symbols-outlined">save</i>
            </button>
            <span class="ml-3" style="font-size: 15px; color: #818181;">Se deberán guardar los cambios realizados
                presionando el icono "Guardar"</span>
            <button type="button" style="background-color: transparent; border: none;" data-toggle="modal" data-target="#modalTutorial">
                <i class="fas fa-lightbulb fa-2x pulse" style="color: #FFBB00"></i>
            </button>
        </div>
    </div>

    <div>
        <input type="file" name="load-file" id="load-file" style="display: none;">
        <label for="load-file" style="display: none;">Load</label>
        <button style="display: none;" onclick='newProject();' class='button requireWrite newproject'><em>clear
                project</em></button>
        <button class="button login" title="login/enroll" onclick="loginEnroll($(this));"
            style="display:none;">login/enroll</button>
        <button class="button opt collab" title="Start with Twproject" onclick="collaborate($(this));"
            style="display:none;"><em>collaborate</em></button>
    </div>
    <div class="mt-4">
        <span><strong id="version_actual_gantt" style="text-transform:capitalize"></strong>
    </div>
</div>
