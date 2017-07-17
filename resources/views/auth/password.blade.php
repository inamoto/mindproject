{{-- resources/views/auth/password.blade.php --}}
@extends('layout.body')
@section('content')
            <div class="page-header">
                <div class="container">
                    <h2>Password Reset</h2>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel-body">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Error!</strong>
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
                                        {!! Form::label('email', 'メールアドレス', array('class' => 'col-md-3 text-right')) !!}
                                        <div class="col-md-9">
                                            {!! Form::input('email','email','', array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            {!! Form::submit('パスワードを再発行する', array('class' => 'btn btn-success')) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection