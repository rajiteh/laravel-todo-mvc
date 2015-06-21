angular.module 'todoApp.config', []
.value 'todoApp.config',
  apiBaseUrl: 'api/v1',
  templateBaseUrl: 'partials'

angular.module 'todoApp.resource', [
  'ngResource'
  'todoApp.config'
]

angular.module 'todoApp.services', [
  'ngCookies'
  'ngResource'
  'todoApp.config'
  'todoApp.resource'
]

angular.module 'todoApp', [
  'todoApp.config'
  'todoApp.services'
]

