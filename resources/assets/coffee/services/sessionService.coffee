angular.module('todoApp.services').factory('SessionService', [
  '$log'
  '$q'
  '$resource'
  '$cookieStore'
  ($log, $q, $resource, $cookieStore)->
    USER_COOKIE = 'userCookie'

    service = $resource '/api/vsession/:param', {},
      'login':
        method: 'POST'
      'logout':
        method: 'DELETE'

    currentUser = false

    authorized = ->
      getCurrentUser().authorized is 'true'

    login = (newUser)->

      #promise = service.login(newUser).$promise
      #simulate ajax call via a promise
      promise = $q((resolve, reject) ->

        setTimeout ->
          if (newUser.email > 0 and newUser.email < 11)
            resolve
              user:
                id: newUser.email,
                name: "User #{newUser.email}"
              authorized: 'true'
          else
            reject('Type a number between 1 and 10')
        , 300
      )

      promise.then (result)->
        updateCurrentUser(result.user, result.authorized)

      promise

    logout = ->
      #service.logout(param: currentUser.id).$promise
      promise = $q((resolve, reject) ->
        setTimeout ->
          resolve()
        , 100
      )
      promise.then ->
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