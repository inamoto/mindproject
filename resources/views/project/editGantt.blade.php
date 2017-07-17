@extends('layout.body')
@section('content')
                <div class="container">
                    <table>
                        <tr>
                            <td>
                                <form method="post" name="form_save" id="form_save" action="/laravel/sample/public/project/postga">
                                    <input type="hidden" name="title" id="title"  value="{{$project->title}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="gantt" id="gantt" value="">
                                    <input type="hidden" name="path" id="path" value="{{ Request::path()}}">
                                    <a class="btn btn-primary btn-xs" onclick=onSave();><i class="glyphicon glyphicon-floppy-save">Save</i></a>
                                </form>
                            </td>
                            <td>
                                <form method="post" name="form_toMM" id="form_toMM" action="/laravel/sample/public/project/tomm">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="title2" id="title2"  value="{{$project->title}}">
                                    <input type="hidden" name="mindmap2" id="mindmap2" value="">
                                    <input type="hidden" name="ganttData2" id="ganttData2" value="">
                                    <input type="hidden" name="path2" id="path2" value="{{ Request::path()}}">
                                    <a class="btn btn-success btn-xs" onclick=onToMM();><i class="glyphicon glyphicon-asterisk">Mindmap</i></a>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="workSpace" style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px"></div>
                @include('project.ganttconfigure')
                <form id="gimmeBack" style="display:none;" action="../gimmeBack.jsp" method="post" target="_blank"><input type="hidden" name="prj" id="gimBaPrj"></form>

                <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                <script src="/laravel/sample/public/js/ganttlibs/jquery/jquery.livequery.1.1.1.min.js"></script>
                <script src="/laravel/sample/public/js/ganttlibs/jquery/jquery.timers.js"></script>
                <script src="/laravel/sample/public/js/ganttlibs/utilities.js"></script><!---->
                <script src="/laravel/sample/public/js/ganttlibs/forms.js"></script><!---->
                <script src="/laravel/sample/public/js/ganttlibs/date.js"></script>
                <script src="/laravel/sample/public/js/ganttlibs/dialogs.js"></script><!---->
                <script src="/laravel/sample/public/js/ganttlibs/layout.js"></script><!---->
                <script src="/laravel/sample/public/js/ganttlibs/i18nJs.js"></script>
                <script src="/laravel/sample/public/js/ganttlibs/jquery/dateField/jquery.dateField.js"></script>
                <script src="/laravel/sample/public/js/ganttlibs/jquery/JST/jquery.JST.js"></script>
                <script type="text/javascript" src="/laravel/sample/public/js/ganttlibs/jquery/svg/jquery.svg.min.js"></script><!---->
                <script type="text/javascript" src="/laravel/sample/public/js/ganttlibs/jquery/svg/jquery.svgdom.1.8.js"></script><!---->
                <script src="/laravel/sample/public/js/ganttUtilities.js"></script>
                <script src="/laravel/sample/public/js/ganttTask.js"></script>
                <script src="/laravel/sample/public/js/ganttDrawerSVG.js"></script>
                <script src="/laravel/sample/public/js/ganttGridEditor.js"></script>
                <script src="/laravel/sample/public/js/ganttMaster.js"></script>  
                <script src="/laravel/sample/public/js/gantt.temp.js"></script><!---->
                <script type="text/javascript">
                    function generateMMData(gantt){

                    }
                    function onSave(){
                        var prj = ge.saveProject();
                        if(prj.tasks.length>0){
                            document.getElementById('title');
                            document.getElementById('gantt').value=JSON.stringify(prj);
                            document.getElementById('form_save').submit();
                        }
                    }
                    function onToMM(){
                        var prj = ge.saveProject();
                        
                        if(prj.tasks.length>0){
                            var newMind = generageMMData(prj);;
                            document.getElementById('title2');
                            document.getElementById('ganttData2').value=JSON.stringify(prj);
                            //document.getElementById('mindmap2').value=JSON.stringify(newMind);
                            document.getElementById('form_toMM').submit();
                        }                        
                    }     
                    var ge;
                    $(function() {
                        var canWrite=true;
                        ge = new GanttMaster();
                        var workSpace = $("#workSpace");
                        workSpace.css({width:$(window).width(),height:$(window).height()});
                        ge.init(workSpace);
                        loadI18n(); //overwrite with localized ones
                        delete ge.gantt.zoom;
                        //var project=loadFromLocalStorage();
                        var project = {!!$project->gantt!!};
                        if (!project.canWrite)
                            $(".ganttButtonBar button.requireWrite").attr("disabled","true");
                        ge.loadProject(project);
                        ge.checkpoint(); //empty the undo stack
                        ge.editor.element.oneTime(100, "cl", function () {$(this).find("tr.emptyRow:first").click()});
                        $(window).resize(function(){
                            workSpace.css({width:$(window).width() - 1,height:$(window).height() - workSpace.position().top});
                            workSpace.trigger("resize.gantt");
                        }).oneTime(150,"resize",function(){$(this).trigger("resize")});
                    });
                </script>   
@endsection