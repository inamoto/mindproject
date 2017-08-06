@extends('layout.body')
@section('content')
                <script>
                    function onDestroyButton(e) {
                        'use strict';
                        if (confirm('Are you sure to delete this project?')) 
                        {
                            var form = 'form_destroy'+e;
                            document.getElementById(form).submit();
                        }
                    }
                </script>
                <div class="page-header">
                    <div class="container"><h1>Dashboard</h1></div>
                </div>
                <div class="container">
                    <table class="table table-striped table-hover"> 
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Created</th>
                                <!--<th>Updated at</th>-->
                                <th>
                                    <form method="post" action="/mindproject/public/project/create">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="submit" class="btn btn-primary btn-xL" value="+ New Project">   
                                    </form>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td><b>{{{ $project->title }}}</b></td>
                                <td><font size="1">{{{ date_format(new DateTime($project->created_at), 'm/d H:i') }}}</font></td>
                                <!-- <td>{{{ date_format(new DateTime($project->updated_at), 'm/d H:i') }}}</td> -->
                                <td>
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>
                                                    <a href="/mindproject/public/project/mindmap/{{$project->uuid}}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-asterisk">Mindmap</i></a>
                                                </td>
                                                <td>
                                                    <a href="/mindproject/public/project/gantt/{{$project->uuid}}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-tasks">Gantt</i></a>
                                                </td>
                                                <td>
                                                    <form method="post" name="form_destroy{{$project->id}}" id="form_destroy{{$project->id}}" action="/mindproject/public/project/destroy/{{$project->uuid}}">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <a class="btn btn-danger btn-xs" onclick=onDestroyButton({{$project->id}});><i class="glyphicon glyphicon-trash">Remove</i></a>
                                                    </form>       
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>                  
                                </td>
                            </tr>                            
                            @endforeach
                        </tbody>
                    </table>
                </div>

@endsection