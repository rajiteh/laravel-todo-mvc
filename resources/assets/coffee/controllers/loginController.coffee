angular.module('todoApp').controller 'LoginController'
, [ '$log'
    '$scope'
    'SessionService'
    ($log, $scope, SessionService) ->


      @user = false

      @authorized = -> SessionService.authorized()

      @credentials = {}

      @login = ->
        SessionService.login(@credentials)
        .then ->
          @user = SessionService.getCurrentUser()
        , (err) =>
          alert(err)

      @logout = -> SessionService.logout()

      init = =>
        @user = SessionService.getCurrentUser()

      init()
      @

  ]