@extends('layouts.master')

@section('title', 'Home')

@section('content')

    {!! Form::open(['action' => 'Auth\AuthController@postLogin']) !!}
        {!! csrf_field() !!}

        <div>
            Email
            {!! Form::email('email', old('email')) !!}
        </div>

        <div>
            Password
            {!! Form::password('password', "", ["id" => "password"] ) !!}
        </div>

        <div>
            {!! Form::checkbox('remember') !!}
            Remember me
        </div>

        <div>
            {!! Form::submit('Login') !!}
        </div>

    {!! Form::close() !!}
    {!! HTML::link(URL::action('Auth\AuthController@getRegister'), "Register?") !!}

@stop