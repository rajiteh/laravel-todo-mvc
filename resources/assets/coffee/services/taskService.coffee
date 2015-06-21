angular.module('todoApp.services').factory('Task', [
  '$log', 'Resource'
  ($log, $resource) ->
    $resource('checklist/:check_list_id/tasks/:id', { check_list_Id: '@check_list_id', id: '@id' })
])
