<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" ng-controller="LoginController as loginCtrl">
            <form class="navbar-form navbar-right ng-hide" role="form" ng-hide="loginCtrl.authorized()">
                <div class="form-group">
                    <input type="text" placeholder="Email" class="form-control" ng-model="loginCtrl.credentials.email">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" ng-model="loginCtrl.credentials.password">
                </div>
                <button type="submit" class="btn btn-success" ng-click="loginCtrl.login()">Sign in</button>
            </form>

            <form class="navbar-form navbar-right ng-hide" role="form" ng-show="loginCtrl.authorized()">
                <button type="submit" class="btn btn-success" ng-click="loginCtrl.logout()">Sign out</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>