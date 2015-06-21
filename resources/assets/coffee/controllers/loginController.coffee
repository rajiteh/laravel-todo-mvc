angular.module('todoApp').controller 'LoginController'
, [ '$log'
    '$scope'
    'SessionService'
    ($log, $scope, SessionService) ->


      @user = SessionService.getCurrentUser()

      @authorized = -> SessionService.authorized()

      @credentials = {}

      @login = ->
        SessionService.login(@credentials)
        .then ->
          false
        , (err) =>
          alert(err)

      @logout = -> SessionService.logout()

      @
  ]