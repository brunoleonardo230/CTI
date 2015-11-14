var app = angular.module('myApp', []);

app.config(function($interpolateProvider) {

    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');

});

app.controller("RequiredCtrl", function($scope) {

	$scope.required = " ";

	$scope.select = false;

	$scope.poloid = " ";

});