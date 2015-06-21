angular.module('todoApp.services').factory('SessionService', [
  '$log'
  '$q'
  '$resource'
  '$cookieStore'
  ($log, $q, $resource, $cookieStore)->
    USER_COOKIE = 'userCookie'

    loginRes = $resource '/auth/login', {},
      'login':
        method: 'POST'

    logoutRes = $resource '/auth/logout', {},
      'logout':
        method: 'GET'

    currentUser = {}

    authorized = ->
      getCurrentUser().authorized is 'true'

    login = (newUser)->
      newUser.token = $('input[name=_token]').val()

      #simulate ajax call via a promise


      promise = loginRes.login(newUser).$promise
      promise.then (result)->
        updateCurrentUser(result, true)

      promise

    logout = ->
      promise = logoutRes.logout().$promise
      promise.then (f) ->
        updateCurrentUser({}, false)
      promise


    updateCurrentUser = (user, authStatus)->
      if authStatus and user? and user.id? and user.name?
        currentUser.id = user.id
        currentUser.name = user.name
        currentUser.authorized = authStatus + ""
      else
        currentUser = { authorized: false + "" }

      $cookieStore.put(USER_COOKIE , currentUser)


    getCurrentUser = ->
      cookieUser = $cookieStore.get(USER_COOKIE)
      if cookieUser?
        currentUser = cookieUser
      currentUser

    {
      login
      logout
      authorized
      getCurrentUser
    }
])