angular.module('todoApp').controller 'MainController'
, [ '$log'
    'CheckList'
    'SessionService'
    ($log, CheckList, SessionService) ->

      @authorized = ->
        SessionService.authorized()

  ]