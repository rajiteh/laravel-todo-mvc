angular.module('todoApp.services').factory('Task', [
  '$log', 'Resource'
  ($log, $resource) ->
    $resource('checklists/:check_list_id/tasks/:id', { check_list_Id: '@data.check_list_id', id: '@data.id' })
])
