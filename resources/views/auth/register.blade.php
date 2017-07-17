@extends('layout.body')
@section('content')
                <div class="page-header">
                    <div class="container">
                        <h2>Sign up</h2>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel-body">
                                 @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Error!</strong>　Cannot Register
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="form-horizontal">
                                    {!! Form::open() !!}
                                        <div class="form-group">
                                            {!! Form::label('email', 'Mail', array('class' => 'col-md-4 text-right')) !!}
                                            <div class="col-md-8">
                                                {!! Form::input('email','email','', array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('password', 'Password', array('class' => 'col-md-4 text-right')) !!}
                                            <div class="col-md-8">
                                                {!! Form::input('password','password','', array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                         {!! Form::label('password_confirmation', 'Password Confirm', array('class' => 'col-md-4 text-right')) !!}
                                            <div class="col-md-8">
                                                {!! Form::input('password','password_confirmation','', array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
 
                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8">
                                                {!! Form::submit('Sign Up', array('class' => 'btn btn-primary')) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection