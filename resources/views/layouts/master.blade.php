<!doctype html>
<html ng-app="todoApp">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>

    <title>Todo MVC - @yield('title')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! HTML::style(URL::asset('css/vendor.css')) !!}
    {!! HTML::style(URL::asset('css/app.css')) !!}
    {!! HTML::style(URL::asset('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css')) !!}



</head>
<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    @include('_partials.navbar')

    <div class="container">
    @yield('content')

    <hr>

    @include('_partials.footer')
    </div> <!-- /container -->

    {!! HTML::script(URL::asset('js/vendor.js')) !!}

    {!! HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js') !!}
    {!! HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-resource.min.js') !!}
    {!! HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-route.min.js') !!}
    {!! HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-cookies.min.js') !!}

    {!! HTML::script(URL::asset('js/app.js')) !!}

</body>
</html>
