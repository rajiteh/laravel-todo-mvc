angular.module('todoApp.resource').factory 'Resource', [
  '$resource', 'todoApp.config'
  ($resource, config) ->
    (url, params, methods) ->
      defaults =
        update:
          method: 'put'
          isArray: false
        create: method: 'post'
      methods = angular.extend(defaults, methods)
      resource = $resource("#{config.apiBaseUrl}/#{url}", params, methods)

      resource::$save = ->
        if !@id
          @$create()
        else
          @$update()

      resource
]
