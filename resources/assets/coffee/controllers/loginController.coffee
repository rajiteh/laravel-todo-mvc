angular.module('todoApp').controller 'LoginController'
, [ '$log'
    '$scope'
    'SessionService'
    ($log, $scope, SessionService) ->


      @user = false

      @authorized = -> SessionService.authorized()

      @credentials = {}

      @login = ->
        if (@credentials.email? and @credentials.email.length > 0 and @credentials.password? and @credentials.password.length > 0)
         SessionService.login(@credentials)
            .then ->
              @user = SessionService.getCurrentUser()
            , (err) =>
              alert("Could not authenticate. Try 'user1@example.com' and 'password1'.")

      @logout = -> SessionService.logout()

      init = =>
        @user = SessionService.getCurrentUser()

      init()
      @

  ]