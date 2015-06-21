@extends('layouts.master')

@section('title', 'Home')

@section('content')


    {!! Form::open(['action' => 'Auth\AuthController@postRegister']) !!}
    {!! csrf_field() !!}

    <div class="form-group">
        {!! Form::label('name','Name') !!}

        {!! Form::text('name', old('name'), ["placeholder" => "Name", "class" =>"form-control", "required" => "required"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email','Email') !!}
        {!! Form::email('email', old('email'), ["placeholder" => "Email", "class" =>"form-control", "required" => "required"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password','Password') !!}
        {!! Form::password('password', ["class" =>"form-control", "required" => "required"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation','Confirm Password') !!}
        {!! Form::password('password_confirmation',["class" =>"form-control", "required" => "required"]) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Register', [ "class" => "btn btn-default"]) !!}
    </div>

    {!! Form::close() !!}

@stop