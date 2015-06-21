(function() {
  angular.module('todoApp.config', []).value('todoApp.config', {
    apiBaseUrl: 'api/v1',
    templateBaseUrl: 'partials'
  });

  angular.module('todoApp.resource', ['ngResource', 'todoApp.config']);

  angular.module('todoApp.services', ['ngCookies', 'ngResource', 'todoApp.config', 'todoApp.resource']);

  angular.module('todoApp', ['todoApp.config', 'todoApp.services']);

}).call(this);

(function() {
  angular.module('todoApp.resource').factory('Resource', [
    '$resource', 'todoApp.config', function($resource, config) {
      return function(url, params, methods) {
        var defaults, resource;
        defaults = {
          update: {
            method: 'put',
            isArray: false
          },
          create: {
            method: 'post'
          }
        };
        methods = angular.extend(defaults, methods);
        resource = $resource(config.apiBaseUrl + "/" + url, params, methods);
        resource.prototype.$save = function() {
          if (!this.id) {
            return this.$create();
          } else {
            return this.$update();
          }
        };
        return resource;
      };
    }
  ]);

}).call(this);

(function() {
  angular.module('todoApp.services').factory('CheckList', [
    '$log', 'Resource', function($log, $resource) {
      return $resource('checklists/:id', {
        id: '@id'
      });
    }
  ]);

}).call(this);

(function() {
  angular.module('todoApp.services').factory('SessionService', [
    '$log', '$q', '$resource', '$cookieStore', function($log, $q, $resource, $cookieStore) {
      var USER_COOKIE, authorized, currentUser, getCurrentUser, login, loginRes, logout, logoutRes, updateCurrentUser;
      USER_COOKIE = 'userCookie';
      loginRes = $resource('/auth/login', {}, {
        'login': {
          method: 'POST'
        }
      });
      logoutRes = $resource('/auth/logout', {}, {
        'logout': {
          method: 'GET'
        }
      });
      currentUser = {};
      authorized = function() {
        return getCurrentUser().authorized === 'true';
      };
      login = function(newUser) {
        var promise;
        newUser.token = $('input[name=_token]').val();
        promise = loginRes.login(newUser).$promise;
        promise.then(function(result) {
          return updateCurrentUser(result, true);
        });
        return promise;
      };
      logout = function() {
        var promise;
        promise = logoutRes.logout().$promise;
        promise.then(function(f) {
          return updateCurrentUser({}, false);
        });
        return promise;
      };
      updateCurrentUser = function(user, authStatus) {
        if (authStatus && (user != null) && (user.id != null) && (user.name != null)) {
          currentUser.id = user.id;
          currentUser.name = user.name;
          currentUser.authorized = authStatus + "";
        } else {
          currentUser = {
            authorized: false + ""
          };
        }
        return $cookieStore.put(USER_COOKIE, currentUser);
      };
      getCurrentUser = function() {
        var cookieUser;
        cookieUser = $cookieStore.get(USER_COOKIE);
        if (cookieUser != null) {
          currentUser = cookieUser;
        }
        return currentUser;
      };
      return {
        login: login,
        logout: logout,
        authorized: authorized,
        getCurrentUser: getCurrentUser
      };
    }
  ]);

}).call(this);

(function() {
  angular.module('todoApp.services').factory('Task', [
    '$log', 'Resource', function($log, $resource) {
      return $resource('checklists/:check_list_id/tasks/:id', {
        check_list_Id: '@data.check_list_id',
        id: '@data.id'
      });
    }
  ]);

}).call(this);

(function() {
  angular.module('todoApp').controller('CheckListController', [
    '$log', 'CheckList', 'SessionService', 'Task', function($log, CheckList, SessionService, Task) {
      var getCheckLists, getUserId, init, saveChecklist, saveTask;
      this.checklists = [];
      this.tasks = [];
      getUserId = (function(_this) {
        return function() {
          return SessionService.getCurrentUser().id;
        };
      })(this);
      getCheckLists = (function(_this) {
        return function() {
          var userId;
          userId = getUserId();
          return _this.checklists = CheckList.get({
            user_id: userId
          });
        };
      })(this);
      this.loadTasksFor = function(index, checklistId) {
        return this.tasks[index] = Task.get({
          check_list_id: checklistId
        });
      };
      this.toggleTask = function(parentIndex, index) {
        if (this.tasks[parentIndex].data[index].attributes.done === "0") {
          this.tasks[parentIndex].data[index].attributes.done = "1";
        } else {
          this.tasks[parentIndex].data[index].attributes.done = "0";
        }
        return saveTask(parentIndex, index);
      };
      this.editChecklistName = function(index) {
        var newName;
        newName = prompt("Change name?", this.checklists.data[index].attributes.name);
        if (newName.length > 0) {
          this.checklists.data[index].attributes.name = newName;
          return saveChecklist(index);
        }
      };
      this.deleteCheckList = function(index) {
        CheckList["delete"]({
          id: this.checklists.data[index].id
        });
        this.checklists.data.splice(index, 1);
        return this.tasks.splice(index, 1);
      };
      this.editTaskTitle = function(parentIndex, index) {
        var newTitle;
        newTitle = prompt("Change title?", this.tasks[parentIndex].data[index].attributes.title);
        if (newTitle.length > 0) {
          this.tasks[parentIndex].data[index].attributes.title = newTitle;
          return saveTask(parentIndex, index);
        }
      };
      this.editTaskDescription = function(parentIndex, index) {
        var newDesc;
        newDesc = prompt("Change description?", this.tasks[parentIndex].data[index].attributes.description);
        this.tasks[parentIndex].data[index].attributes.description = newDesc;
        return saveTask(parentIndex, index);
      };
      this.deleteTask = function(parentIndex, index) {
        Task["delete"]({
          check_list_id: this.checklists.data[parentIndex].id,
          id: this.tasks[parentIndex].data[index].id
        });
        return this.tasks[parentIndex].data.splice(index, 1);
      };
      this.newTask = function(parentIndex) {
        var name;
        name = prompt("Title?");
        if (name !== null && name.length > 0) {
          return Task.create({
            check_list_id: this.checklists.data[parentIndex].id
          }, {
            title: name,
            check_list_id: this.checklists.data[parentIndex].id
          }, (function(_this) {
            return function() {
              return _this.loadTasksFor(parentIndex, _this.checklists.data[parentIndex].id);
            };
          })(this));
        }
      };
      this.newCheckList = function() {
        var name;
        name = prompt("Name?");
        if (name !== null && name.length > 0) {
          return CheckList.create({}, {
            name: name,
            user_id: getUserId()
          }, function() {
            return getCheckLists();
          });
        }
      };
      saveChecklist = (function(_this) {
        return function(index) {
          return CheckList.update({
            id: _this.checklists.data[index].id
          }, _this.checklists.data[index].attributes);
        };
      })(this);
      saveTask = (function(_this) {
        return function(parentIndex, index) {
          return Task.update({
            check_list_id: _this.checklists.data[parentIndex].id,
            id: _this.tasks[parentIndex].data[index].id
          }, _this.tasks[parentIndex].data[index].attributes);
        };
      })(this);
      init = function() {
        return getCheckLists();
      };
      init();
      return this;
    }
  ]);

}).call(this);

(function() {
  angular.module('todoApp').controller('LoginController', [
    '$log', '$scope', 'SessionService', function($log, $scope, SessionService) {
      var init;
      this.user = false;
      this.authorized = function() {
        return SessionService.authorized();
      };
      this.credentials = {};
      this.login = function() {
        if ((this.credentials.email != null) && this.credentials.email.length > 0 && (this.credentials.password != null) && this.credentials.password.length > 0) {
          return SessionService.login(this.credentials).then(function() {
            return this.user = SessionService.getCurrentUser();
          }, (function(_this) {
            return function(err) {
              return alert("Could not authenticate. Try 'user1@example.com' and 'password1'.");
            };
          })(this));
        }
      };
      this.logout = function() {
        return SessionService.logout();
      };
      init = (function(_this) {
        return function() {
          return _this.user = SessionService.getCurrentUser();
        };
      })(this);
      init();
      return this;
    }
  ]);

}).call(this);

(function() {
  angular.module('todoApp').controller('MainController', [
    '$log', 'CheckList', 'SessionService', function($log, CheckList, SessionService) {
      return this.authorized = function() {
        return SessionService.authorized();
      };
    }
  ]);

}).call(this);

(function() {
  angular.module('todoApp').controller('TaskSetController', [
    '$log', 'Task', 'SessionService', function($log, CheckList, Task) {
      this.tasks = [];
      this.loadFor = (function(_this) {
        return function(checklistId) {
          console.log("Trying to load checklist");
          return Task.get({
            check_list_id: checklistId
          }, function(resp) {
            _this.tasks = resp.data;
            return console.log(_this.tasks, _this);
          });
        };
      })(this);
      return this;
    }
  ]);

}).call(this);

//# sourceMappingURL=app.js.map