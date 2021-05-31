@extends('layouts.admin')
@section('content')




<div class="card mt-5">
  <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
      <h3 class="mb-2  text-center text-white"><i class="fas fa-paper-plane" style="margin-right: 15px;"></i> <strong> Implementación de ISO 27001</strong></h3>
  </div>

    <div class="card-body">
    <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-fill" id="myTabJust" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab"
                           aria-controls="home-just"
                           aria-selected="true"><font class="letra_blanca">Introducción</font></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab"
                           aria-controls="profile-just"
                           aria-selected="false"><font class="letra_blanca">Guía
                            de Implementación</font></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="plan-tab-just" data-toggle="tab" href="#plan-just" role="tab"
                           aria-controls="plan-just"
                           aria-selected="false"><font class="letra_blanca">Plan
                            de Trabajo Base</font></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#just" role="tab"
                           aria-controls="contact-just"
                           aria-selected="false"><font class="letra_blanca">Consultoría
                            en línea</font></a>
                    </li>
                </ul>

                <div class="tab-content card" id="myTabContentJust">

                    <div class="tab-pane fade show active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just" style="margin-top: 30px; padding: 0 30px;">
                        @include('admin.implementacions.introduccion')
                    </div>



                    <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just" style="margin-top: 30px;">
                       @include('admin.implementacions.guia')
                    </div>
                    
                    <div class="tab-pane fade" id="plan-just" role="tabpanel" aria-labelledby="plan-tab-just">
                         @include('admin.implementacions.plantrabajo')
                    </div>



                    <div class="tab-pane fade" id="just" role="tabpanel" aria-labelledby="contact-tab-just" style="margin-top: 30px;">
                        @include('admin.implementacions.consultoria')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
        
    const ejecutar = document.querySelector('#profile-tab-classic');
    ejecutar.addEventListener('click', () => {
        document.getElementById('profile-tab-just').classList.add('active');
        document.getElementById('profile-just').classList.add('active');
        document.getElementById('profile-just').classList.add('show');


        document.getElementById('home-tab-just').classList.remove('active');
        document.getElementById('home-just').classList.remove('active');
        document.getElementById('home-just').classList.remove('show');
    });
      
</script>

@endsection

@section('scripts')

      <script src="{{asset('../jquery_gantt/libs/jquery/jquery.livequery.1.1.1.min.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/jquery/jquery.timers.js')}}"></script>

      <script src="{{asset('../jquery_gantt/libs/utilities.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/forms.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/date.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/dialogs.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/layout.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/i18nJs.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/jquery/dateField/jquery.dateField.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/jquery/JST/jquery.JST.js')}}"></script>
      <script src="{{asset('../jquery_gantt/libs/jquery/valueSlider/jquery.mb.slider.js')}}"></script>

      <script type="text/javascript" src="{{asset('../jquery_gantt/libs/jquery/svg/jquery.svg.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('../jquery_gantt/libs/jquery/svg/jquery.svgdom.1.8.js')}}"></script>


      <script src="{{asset('../jquery_gantt/ganttUtilities.js')}}"></script>
      <script src="{{asset('../jquery_gantt/ganttTask.js')}}"></script>
      <script src="{{asset('../jquery_gantt/ganttDrawerSVG.js')}}"></script>
      <script src="{{asset('../jquery_gantt/ganttZoom.js')}}"></script>
      <script src="{{asset('../jquery_gantt/ganttGridEditor.js')}}"></script>
      <script src="{{asset('../jquery_gantt/ganttMaster.js')}}"></script>  


      <script type="text/javascript">

            var ge;
            $(function() {
              var canWrite=true; //this is the default for test purposes

              // here starts gantt initialization
              ge = new GanttMaster();
              ge.set100OnClose=true;

              ge.shrinkParent=true;

              ge.init($("#workSpace"));
              loadI18n(); //overwrite with localized ones


              
             $.ajax({

                    type: "POST",

                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

               

                    url: "{{route('admin.implementacions.loadProyect')}}",



                    success: function (response) {
                      ge.loadProject(response);
                      ge.checkpoint(); //empty the undo stack 

                      console.log(ge.tasks);

                      initializeHistoryManagement(ge.tasks[0].id);
                    }

                });
              

                    

             

              
            


              






              //in order to force compute the best-fitting zoom level
              delete ge.gantt.zoom;

              // var project=loadFromLocalStorage();

              // if (!project.canWrite)
              //   $(".ganttButtonBar button.requireWrite").attr("disabled","true");

              // ge.loadProject(project);
              // ge.checkpoint(); 


            });

            let it_ln = [

                @foreach($fases as $fase)

                          { 
                            "id": 900{{$fase->id}}, 
                            "id_fase": {{$fase->id}},
                            "url": '',
                            "name": "{{$fase->fase_nombre}}", 
                            "level": 0,
                            "status": "STATUS_ACTIVE",
                          },

                    @foreach($fase->plan_base_actividades as $actividadplan)  

                          { 
                            "id": 800{{$actividadplan->id}}, 
                            "id_fase": {{$actividadplan->id}},
                            "url": '',
                            "name": "{{$actividadplan->actividad}}", 
                            "start": {{strtotime(Carbon\Carbon::parse($actividadplan->fecha_inicio)->format('M d Y')) * 1000}}, 
                            "end": {{strtotime(Carbon\Carbon::parse($actividadplan->fecha_fin)->format('M d Y')) * 1000}}, 
                            "level": 1,
                          },
                        
                    @endforeach
                
                @endforeach

              ];

            function getDemoProject(){
              //console.debug("getDemoProject")
            ret= {"tasks":  [], }


                //actualize data
                
              return ret;
            }



            function loadGanttFromServer(taskId, callback) {

              //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
              var ret=loadFromLocalStorage();

              //this is the real implementation
              /*
              //var taskId = $("#taskSelector").val();
              var prof = new Profiler("loadServerSide");
              prof.reset();

              $.getJSON("ganttAjaxController.jsp", {CM:"LOADPROJECT",taskId:taskId}, function(response) {
                //console.debug(response);
                if (response.ok) {
                  prof.stop();

                  ge.loadProject(response.project);
                  ge.checkpoint(); //empty the undo stack

                  if (typeof(callback)=="function") {
                    callback(response);
                  }
                } else {
                  jsonErrorHandling(response);
                }
              });
              */

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

              // console.log(JSON.stringify(prj, null, '\t'));

              var txt_prj = JSON.stringify(prj, null, '\t');

              $.ajax({

                type: "post",


                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

               

                url: "{{route('admin.implementacions.saveProyect')}}",

                data: {txt_prj},

                success: function (response) {
                  
                }

            });

              // download(JSON.stringify(prj, null, '\t'), "MyProject.json", "application/json");

              /*

              delete prj.resources;
              delete prj.roles;

              var prof = new Profiler("saveServerSide");
              prof.reset();

              if (ge.deletedTaskIds.length>0) {
                if (!confirm("TASK_THAT_WILL_BE_REMOVED\n"+ge.deletedTaskIds.length)) {
                  return;
                }
              }

              $.ajax("ganttAjaxController.jsp", {
                dataType:"json",
                data: {CM:"SVPROJECT",prj:JSON.stringify(prj)},
                type:"POST",

                success: function(response) {
                  if (response.ok) {
                    prof.stop();
                    if (response.project) {
                      ge.loadProject(response.project); //must reload as "tmp_" ids are now the good ones
                    } else {
                      ge.reset();
                    }
                  } else {
                    var errMsg="Errors saving project\n";
                    if (response.message) {
                      errMsg=errMsg+response.message+"\n";
                    }

                    if (response.errorMessages.length) {
                      errMsg += response.errorMessages.join("\n");
                    }

                    alert(errMsg);
                  }
                }

              });
              */
            }

            // Function to download data to a file
            function download(data, filename, type) {
              var file = new Blob([data], {type: type});
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

            function newProject(){
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
                if (localStorage.getObject("teamworkGantDemo")) {
                  ret = localStorage.getObject("teamworkGantDemo");
                }
              }

              //if not found create a new example task
              if (!ret || !ret.tasks || ret.tasks.length == 0){
                ret=getDemoProject();
              }
              return ret;
            }


            function saveInLocalStorage() {
              var prj = ge.saveProject();

              if (localStorage) {
                localStorage.setObject("teamworkGantDemo", prj);
              }
            }


            //-------------------------------------------  Open a black popup for managing resources. This is only an axample of implementation (usually resources come from server) ------------------------------------------------------
            function editResources(){

              //make resource editor
              var resourceEditor = $.JST.createFromTemplate({}, "RESOURCE_EDITOR");
              var resTbl=resourceEditor.find("#resourcesTable");

              for (var i=0;i<ge.resources.length;i++){
                var res=ge.resources[i];
                resTbl.append($.JST.createFromTemplate(res, "RESOURCE_ROW"))
              }


              //bind add resource
              resourceEditor.find("#addResource").click(function(){
                resTbl.append($.JST.createFromTemplate({id:"new",name:"resource"}, "RESOURCE_ROW"))
              });

              //bind save event
              resourceEditor.find("#resSaveButton").click(function(){
                var newRes=[];
                //find for deleted res
                for (var i=0;i<ge.resources.length;i++){
                  var res=ge.resources[i];
                  var row = resourceEditor.find("[resId="+res.id+"]");
                  if (row.length>0){
                    //if still there save it
                    var name = row.find("input[name]").val();
                    if (name && name!="")
                      res.name=name;
                    newRes.push(res);
                  } else {
                    //remove assignments
                    for (var j=0;j<ge.tasks.length;j++){
                      var task=ge.tasks[j];
                      var newAss=[];
                      for (var k=0;k<task.assigs.length;k++){
                        var ass=task.assigs[k];
                        if (ass.resourceId!=res.id)
                          newAss.push(ass);
                      }
                      task.assigs=newAss;
                    }
                  }
                }

                //loop on new rows
                var cnt=0
                resourceEditor.find("[resId=new]").each(function(){
                  cnt++;
                  var row = $(this);
                  var name = row.find("input[name]").val();
                  if (name && name!="")
                    newRes.push (new Resource("tmp_"+new Date().getTime()+"_"+cnt,name));
                });

                ge.resources=newRes;

                closeBlackPopup();
                ge.redraw();
              });


              var ndo = createModalPopup(400, 500).append(resourceEditor);
            }

            function initializeHistoryManagement(taskId){

              //retrieve from server the list of history points in millisecond that represent the instant when the data has been recorded
              //response: {ok:true, historyPoints: [1498168800000, 1498600800000, 1498687200000, 1501538400000, …]}
              $.getJSON(contextPath+"/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTPOINTS", OBJID:taskId}, function (response) {

                //if there are history points
                if (response.ok == true && response.historyPoints && response.historyPoints.length>0) {

                  //add show slider button on button bar
                  var histBtn = $("<button>").addClass("button textual icon lreq30 lreqLabel").attr("title", "SHOW_HISTORY").append("<span class=\"teamworkIcon\">&#x60;</span>");

                  //clicking it
                  histBtn .click(function () {
                    var el = $(this);
                    var ganttButtons = $(".ganttButtonBar .buttons");

                    //is it already on?
                    if (!ge.element.is(".historyOn")) {
                      ge.element.addClass("historyOn");
                      ganttButtons.find(".requireCanWrite").hide();

                      //load the history points from server again
                      showSavingMessage();
                      $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTPOINTS", OBJID: ge.tasks[0].id}, function (response) {
                        jsonResponseHandling(response);
                        hideSavingMessage();
                        if (response.ok == true) {
                          var dh = response.historyPoints;
                          if (dh && dh.length > 0) {
                            //si crea il div per lo slider
                            var sliderDiv = $("<div>").prop("id", "slider").addClass("lreq30 lreqHide").css({"display":"inline-block","width":"500px"});
                            ganttButtons.append(sliderDiv);

                            var minVal = 0;
                            var maxVal = dh.length-1 ;

                            $("#slider").show().mbSlider({
                              rangeColor : '#2f97c6',
                              minVal     : minVal,
                              maxVal     : maxVal,
                              startAt    : maxVal,
                              showVal    : false,
                              grid       :1,
                              formatValue: function (val) {
                                return new Date(dh[val]).format();
                              },
                              onSlideLoad: function (obj) {
                                this.onStop(obj);

                              },
                              onStart    : function (obj) {},
                              onStop     : function (obj) {
                                var val = $(obj).mbgetVal();
                                showSavingMessage();
                                /**
                                 * load the data history for that milliseconf from server
                                 * response in this format {ok: true, baselines: {...}}
                                 *
                                 * baselines: {61707: {duration:1,endDate:1550271599998,id:61707,progress:40,startDate:1550185200000,status:"STATUS_WAITING",taskId:"3055"},
                                 *            {taskId:{duration:in days,endDate:in millis,id:history record id,progress:in percent,startDate:in millis,status:task status,taskId:"3055"}....}}                     */

                                $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTORYAT", OBJID: ge.tasks[0].id, millis:dh[val]}, function (response) {
                                  jsonResponseHandling(response);
                                  hideSavingMessage();
                                  if (response.ok ) {
                                    ge.baselines=response.baselines;
                                    ge.showBaselines=true;
                                    ge.baselineMillis=dh[val];
                                    ge.redraw();
                                  }
                                })

                              },
                              onSlide    : function (obj) {
                                clearTimeout(obj.renderHistory);
                                var self = this;
                                obj.renderHistory = setTimeout(function(){
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

                      ge.showBaselines=false;
                      ge.baselineMillis=undefined;
                      ge.redraw();
                    }

                  });
                  $("#saveGanttButton").before(histBtn);
                }
              })
            }

            function showBaselineInfo (event,element){
              //alert(element.attr("data-label"));
              $(element).showBalloon(event, $(element).attr("data-label"));
              ge.splitter.secondBox.one("scroll",function(){
                $(element).hideBalloon();
              })
            }

            </script>

            <script type="text/javascript">
              $.JST.loadDecorator("RESOURCE_ROW", function(resTr, res){
                resTr.find(".delRes").click(function(){$(this).closest("tr").remove()});
              });

              $.JST.loadDecorator("ASSIGNMENT_ROW", function(assigTr, taskAssig){
                var resEl = assigTr.find("[name=resourceId]");
                var opt = $("<option>");
                resEl.append(opt);
                for(var i=0; i< taskAssig.task.master.resources.length;i++){
                  var res = taskAssig.task.master.resources[i];
                  opt = $("<option>");
                  opt.val(res.id).html(res.name);
                  if(taskAssig.assig.resourceId == res.id)
                    opt.attr("selected", "true");
                  resEl.append(opt);
                }
                var roleEl = assigTr.find("[name=roleId]");
                for(var i=0; i< taskAssig.task.master.roles.length;i++){
                  var role = taskAssig.task.master.roles[i];
                  var optr = $("<option>");
                  optr.val(role.id).html(role.name);
                  if(taskAssig.assig.roleId == role.id)
                    optr.attr("selected", "true");
                  roleEl.append(optr);
                }

                if(taskAssig.task.master.permissions.canWrite && taskAssig.task.canWrite){
                  assigTr.find(".delAssig").click(function(){
                    var tr = $(this).closest("[assId]").fadeOut(200, function(){$(this).remove()});
                  });
                }

              });


              function loadI18n(){
                GanttMaster.messages = {
                  "CANNOT_WRITE":"No permission to change the following task:",
                  "CHANGE_OUT_OF_SCOPE":"Project update not possible as you lack rights for updating a parent project.",
                  "START_IS_MILESTONE":"Start date is a milestone.",
                  "END_IS_MILESTONE":"End date is a milestone.",
                  "TASK_HAS_CONSTRAINTS":"Task has constraints.",
                  "GANTT_ERROR_DEPENDS_ON_OPEN_TASK":"Error: there is a dependency on an open task.",
                  "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK":"Error: due to a descendant of a closed task.",
                  "TASK_HAS_EXTERNAL_DEPS":"This task has external dependencies.",
                  "GANNT_ERROR_LOADING_DATA_TASK_REMOVED":"GANNT_ERROR_LOADING_DATA_TASK_REMOVED",
                  "CIRCULAR_REFERENCE":"Circular reference.",
                  "CANNOT_DEPENDS_ON_ANCESTORS":"Cannot depend on ancestors.",
                  "INVALID_DATE_FORMAT":"The data inserted are invalid for the field format.",
                  "GANTT_ERROR_LOADING_DATA_TASK_REMOVED":"An error has occurred while loading the data. A task has been trashed.",
                  "CANNOT_CLOSE_TASK_IF_OPEN_ISSUE":"Cannot close a task with open issues",
                  "TASK_MOVE_INCONSISTENT_LEVEL":"You cannot exchange tasks of different depth.",
                  "CANNOT_MOVE_TASK":"CANNOT_MOVE_TASK",
                  "PLEASE_SAVE_PROJECT":"PLEASE_SAVE_PROJECT",
                  "GANTT_SEMESTER":"Semester",
                  "GANTT_SEMESTER_SHORT":"s.",
                  "GANTT_QUARTER":"Quarter",
                  "GANTT_QUARTER_SHORT":"q.",
                  "GANTT_WEEK":"Week",
                  "GANTT_WEEK_SHORT":"w."
                };
              }



              function createNewResource(el) {
                var row = el.closest("tr[taskid]");
                var name = row.find("[name=resourceId_txt]").val();
                var url = contextPath + "/applications/teamwork/resource/resourceNew.jsp?CM=ADD&name=" + encodeURI(name);

                openBlackPopup(url, 700, 320, function (response) {
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

