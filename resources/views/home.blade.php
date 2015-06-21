@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div ng-controller="MainController as mainCtrl">

        <div class="row" ng-show="mainCtrl.authorized()">
            <div class="" ng-controller="CheckListController as checkListCtrl">
                <div class="col-md-4" ng-repeat="list in checkListCtrl.checklists">
                    OK
                </div>
            </div>

        </div>

        <div class="row" ng-hide="mainCtrl.authorized()">
            Please login above.
        </div>
    </div>

@stop