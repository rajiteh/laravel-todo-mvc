<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Todo MVC</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" ng-controller="LoginController as loginCtrl">
            <form class="navbar-form navbar-right ng-hide" role="form" ng-hide="loginCtrl.authorized()">
                <div class="form-group">
                    {!! csrf_field()  !!}
                    {!! Form::email('email', old('email'), [
                        "placeholder" => "Email",
                        "class" => "form-control",
                        "ng-model" => "loginCtrl.credentials.email",
                        "required" => "required"
                    ]) !!}
                </div>
                <div class="form-group">

                    {!! Form::password('password', [
                    "placeholder" => "Password",
                    "class" => "form-control",
                    "ng-model" => "loginCtrl.credentials.password",
                    "required" => "required"
                    ]) !!}
                </div>

                {!! Form::submit('Sign In', [
                    "class" => "btn btn-success",
                    "ng-click" => "loginCtrl.login()"
                ]) !!}

                {!! HTML::link(URL::action('Auth\AuthController@getRegister'), 'Register', [
                    "class" => "btn btn-success"
                ]) !!}
            </form>

            <form class="navbar-form navbar-right ng-hide" role="form" ng-show="loginCtrl.authorized()">
                {!! csrf_field()  !!}
                {!! Form::submit('Sign out', [
                "class" => "btn btn-success",
                "ng-click" => "loginCtrl.logout()"
                ]) !!}
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>