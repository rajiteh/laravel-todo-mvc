angular.module('todoApp').controller 'CheckListController'
, [ '$log'
    'CheckList'
    'SessionService'
    'Task'
    ($log, CheckList, SessionService, Task) ->

      @checklists = []
      @tasks = []

      getUserId = () => SessionService.getCurrentUser().id

      getCheckLists = () =>
        userId = getUserId()
        @checklists = CheckList.get {user_id: userId}


      @loadTasksFor = (index, checklistId) ->
        console.log 'tryina get atasks', index, checklistId
        @tasks[index] = Task.get {check_list_id: checklistId}

      @toggleTask = (parentIndex, index) ->
        if @tasks[parentIndex].data[index].attributes.done == "0"
          @tasks[parentIndex].data[index].attributes.done = "1"
        else
          @tasks[parentIndex].data[index].attributes.done = "0"
        saveTask(parentIndex, index)

      @editChecklistName = (index) ->
        newName = prompt("Change name?", @checklists.data[index].attributes.name)
        if newName.length > 0
          @checklists.data[index].attributes.name = newName
          saveChecklist(index, old)

      @deleteCheckList = (index) ->
        CheckList.delete id: @checklists.data[index].id
        @checklists.data.splice(index, 1)
        @tasks.splice(index, 1)

      @editTaskTitle = (parentIndex, index) ->
        newTitle = prompt("Change title?", @tasks[parentIndex].data[index].attributes.title)
        if newTitle.length > 0
          @tasks[parentIndex].data[index].attributes.title = newTitle
          saveTask(parentIndex, index)

      @editTaskDescription = (parentIndex, index) ->
        newDesc = prompt("Change description?", @tasks[parentIndex].data[index].attributes.description)
        @tasks[parentIndex].data[index].attributes.description = newDesc
        saveTask(parentIndex, index)

      @deleteTask = (parentIndex, index) ->
        Task.delete
          check_list_id: @checklists.data[parentIndex].id,
          id: @tasks[parentIndex].data[index].id
        @tasks[parentIndex].data.splice(index, 1)
      @newTask = (parentIndex) ->
        name = prompt("Title?")
        if (name != null && name.length > 0)
          Task.create {check_list_id: @checklists.data[parentIndex].id },
            {
              title: name,
              check_list_id: @checklists.data[parentIndex].id
            }, =>
              @loadTasksFor(parentIndex, @checklists.data[parentIndex].id)

      @newCheckList = ->
        name = prompt("Name?")
        if (name != null && name.length > 0)
          CheckList.create {}, {name: name, user_id: getUserId() }, ->
            getCheckLists()

      saveChecklist = (index) =>
        CheckList.update
          id: @checklists.data[index].id
        ,
          @checklists.data[index].attributes


      saveTask = (parentIndex, index) =>
        Task.update
          check_list_id: @checklists.data[parentIndex].id,
          id: @tasks[parentIndex].data[index].id
        ,
          @tasks[parentIndex].data[index].attributes



      init = ->
        getCheckLists()

      init()

      @
  ]