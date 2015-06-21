angular.module('todoApp').controller 'TaskSetController'
, [ '$log'
    'Task'
    'SessionService'
    ($log, CheckList, Task) ->

      @tasks = []

      @loadFor = (checklistId) =>
        console.log("Trying to load checklist")
        Task.get {check_list_id: checklistId}, (resp) =>
          @tasks = resp.data
          console.log(@tasks, @)

      @
  ]