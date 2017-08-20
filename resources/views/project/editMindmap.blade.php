@extends('layout.body')
@section('content')
                    <table>
                        <tr>
                            <td>
                                <a class="btn btn-primary btn-xs" onclick="onAddChild()"><i class="glyphicon glyphicon-plus">Child</i></a>
                                <a class="btn btn-primary btn-xs" onclick="onAddBrother()"><i class="glyphicon glyphicon-plus">Bros.</i></a>
                                <a class="btn btn-primary btn-xs" onclick="onDeleteNode()"><i class="glyphicon glyphicon-trash"></i></a>
                                <a class="btn btn-primary btn-xs" id="change-foreground"><i class="glyphicon glyphicon-text-color"></i></a>
                                <a class="btn btn-primary btn-xs" id="change-background"><i class="glyphicon glyphicon-text-background"></i></a>
                                <!--<a class="btn btn-primary btn-xs" id="colorpicker1" ><i class="glyphicon glyphicon-zoom-in"></i></a>-->
                                <a class="btn btn-primary btn-xs" id="zoom-in-button" onclick="onZoomIn()"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                <a class="btn btn-primary btn-xs" id="zoom-out-button" onclick="onZoomOut()"><i class="glyphicon glyphicon-zoom-out"></i></a>

                            </td>
                            <td>
                                <form method="post" name="form_save" id="form_save" action="/mindproject/public/project/postmm">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="title" id="title"  value="{{$project->title}}">
                                    <input type="hidden" name="mindmap" id="mindmap" value="{{$project->mindmap}}">
                                    <input type="hidden" name="ganttData" id="ganttData" value="{{$project->gantt}}">
                                    <input type="hidden" name="path" id="path" value="{{ Request::path()}}">
                                    <a class="btn btn-primary btn-xs" onclick=onSave();><i class="glyphicon glyphicon-floppy-save"></i></a>
                                </form>
                            </td>
                            <td>
                                <form method="post" name="form_toGantt" id="form_toGantt" action="/mindproject/public/project/toga">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="title2" id="title2"  value="{{$project->title}}">
                                    <input type="hidden" name="mindmap2" id="mindmap2" value="">
                                    <input type="hidden" name="ganttData2" id="ganttData2" value="">
                                    <input type="hidden" name="path2" id="path2" value="{{ Request::path()}}">
                                    <a class="btn btn-success btn-xs" onclick=onToGantt();><i class="glyphicon glyphicon-tasks">Gantt</i></a>
                                </form>
                            </td>
                        </tr>
                    </table>
                <div id="container">
                    <div id="jsmind_container"></div>
                </div>
                <style type="text/css">
                #jsmind_container{ 
                    width:100%;
                    height:100%;
                    border:solid 1px #ccc;
                    background:#fAfAfA;
                    /*background:#ffffff;*/
                }
                </style>

@endsection