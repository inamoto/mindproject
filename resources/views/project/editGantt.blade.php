@extends('layout.body')
@section('content')
                    <table>
                        <tr>
                            <td>
                                <form method="post" name="form_save" id="form_save" action="/mindproject/public/project/postga">
                                    <input type="hidden" name="title" id="title"  value="{{$project->title}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="gantt" id="gantt" value="">
                                    
                                    <input type="hidden" name="path" id="path" value="{{ Request::path()}}">
                                    <a class="btn btn-primary btn-xs" onclick="ge.splitter.resize(.1);return false;"><i class="glyphicon glyphicon-step-backward" aria-hidden="true"></i></a>
                                    <a class="btn btn-primary btn-xs" onclick="ge.splitter.resize(50);return false;"><i class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></i></a>
                                    <a class="btn btn-primary btn-xs" onclick="ge.splitter.resize(100);return false;"><i class="glyphicon glyphicon-step-forward" aria-hidden="true"></i></a>
                                    <a class="btn btn-primary btn-xs" onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                    <a class="btn btn-primary btn-xs" onclick="$('#workSpace').trigger('zoomPlus.gantt'); return false;"><i class="glyphicon glyphicon-zoom-out"></i></a>

                                    <a class="btn btn-primary btn-xs" onclick=onSave();><i class="glyphicon glyphicon-floppy-save"></i></a>
                                </form>
                            </td>
                            <td>
                                <form method="post" name="form_toMM" id="form_toMM" action="/mindproject/public/project/tomm">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="title2" id="title2"  value="{{$project->title}}">
                                    <input type="hidden" name="mindmap2" id="mindmap2" value="">
                                    <input type="hidden" name="ganttData2" id="ganttData2" value="{{$project->gantt}}">
                                    <input type="hidden" name="path2" id="path2" value="{{ Request::path()}}">
                                    <a class="btn btn-success btn-xs" onclick=onToMM();><i class="glyphicon glyphicon-asterisk">Mindmap</i></a>
                                </form>
                            </td>
                        </tr>
                    </table>
                <div id="workSpace" style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px"></div>
                @include('project.ganttconfigure')
                <form id="gimmeBack" style="display:none;" action="../gimmeBack.jsp" method="post" target="_blank"><input type="hidden" name="prj" id="gimBaPrj"></form>

                
@endsection