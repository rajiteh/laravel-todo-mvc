angular.module('todoApp').controller 'CheckListController'
, [ '$log'
    'CheckList'
    'SessionService'
    ($log, CheckList, SessionService) ->

      @checklists = []

      getCheckLists = (userId) =>
        CheckList.get {user_id: userId}, (resp) =>
          @checklists = resp.data


      init = ->
        getCheckLists(SessionService.getCurrentUser().id)

      init()

      @
  ]