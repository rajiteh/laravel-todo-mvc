@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div ng-controller="MainController as mainCtrl">

        <div class="row" ng-if="mainCtrl.authorized()">
            <div class="" ng-controller="CheckListController as checkListCtrl">
                <p class="buttons lead">
                    <a ng-click="checkListCtrl.newCheckList()">[New List]</a>
                </p>
                <div class="col-md-4 checklist" ng-repeat="list in checkListCtrl.checklists.data">

                    <p>
                        <span class="h2"> @{{ list.attributes.name }} </span>
                        <span class="buttons">
                                <a ng-click="checkListCtrl.editChecklistName($index)">[Edit]</a>
                                <a ng-click="checkListCtrl.deleteCheckList($index)">[Delete]</a>
                     </span>
                    </p>


                    <ul ng-init="checkListCtrl.loadTasksFor($index, list.id)">
                        <a ng-click="checkListCtrl.newTask($index)">[New Task]</a>
                        <li ng-repeat="task in checkListCtrl.tasks[$index].data">
                            <form class="form-inline">

                                <div class="form-group">

                                    <label class="lead lead-no-margin">
                                        <input type="checkbox" class="checkbox"
                                               ng-click="checkListCtrl.toggleTask($parent.$index, $index)"
                                               ng-checked="task.attributes.done == '1'"> @{{ task.attributes.title }}
                                    </label>
                                    <span class="buttons">
                                        <a ng-click="checkListCtrl.editTaskTitle($parent.$index, $index)">[Edit]</a>
                                        <a ng-click="checkListCtrl.deleteTask($parent.$index, $index)">[Delete]</a>
                                    </span>
                                    <p class="small"
                                       ng-click="checkListCtrl.editTaskDescription($parent.$index, $index)">
                                       @{{ task.attributes.description || '-- Click here to add a description --'}}
                                       </p>

                                </div>
                            </form>
                        </li>
                    </ul>

                </div>
            </div>

        </div>

        <div class="row" ng-hide="mainCtrl.authorized()">
            Please login above.
        </div>
    </div>

@stop