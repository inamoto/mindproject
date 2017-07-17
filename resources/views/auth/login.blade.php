@extends('layout.body')
@section('content')
            <div class="page-header">
                <div class="container">
                    <h2>Login</h2>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel-body">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Error!</strong>　ログインできませんでした。
                            </div>
                            @endif
                            
                            <div class="form-horizontal">
                                {!! Form::open() !!}
                                {!! csrf_field() !!}
                                    <div class="form-group">
                                        {!! Form::label('email', 'Mail', array('class' => 'col-md-3 text-right')) !!}
                                        <div class="col-md-9">
                                            {!! Form::input('email','email','', array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('password', 'Password', array('class' => 'col-md-3 text-right')) !!}
                                        <div class="col-md-9">
                                            {!! Form::input('password','password','', array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            {!! Form::input('checkbox','remember',null,array('id'=>'remember')) !!}　{!! Form::label('remember', 'Keep Login') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            {!! Form::submit('Login', array('class' => 'btn btn-primary')) !!}<br><br>
                                            <a href="{{ url('password/email') }}">Password Reset</a>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection