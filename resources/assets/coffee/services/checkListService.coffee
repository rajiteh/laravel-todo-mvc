angular.module('todoApp.services').factory('CheckList', [
  '$log', 'Resource'
  ($log, $resource) ->
    $resource('checklists/:id', { id: '@id' })
])
