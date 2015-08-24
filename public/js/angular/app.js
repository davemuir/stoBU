(function(){
	var app  = angular.module('app', [], function($interpolateProvider){
		$interpolateProvider.startSymbol('<%');
		$interpolateProvider.endSymbol('%>');
	});


	app.controller('AppEditController', function(){

	});

	app.controller("PanelController",function(){
		this.tab = 1;

		this.selectTab = function(setTab){
			this.tab = setTab;
		};

		this.isSelected = function(checkTab) {
			return this.tab === checkTab;
		};
	});

function toObject(arr) {
  var rv = {};
  for (var i = 0; i < arr.length; ++i)
    rv[i] = arr[i];
  return rv;
}
	/**
	 * Filter system for Media Manager
	 */

	app.filter('startForm', function() {
		return function(input, start) {
			if(input) {
				start = +start; //parse to int
				return input.slice(start);
			console.log(input);
			}

		}
	});

	app.filter('filterForm', function() {
		return function(input, start) {
			console.log(input);
			console.log(start);
			if(input) {
				start = +start; //parse to int
				return input.slice(start);
			console.log(input);
			}

		}
	});

	/**
	 * Controller for Media Manager retrieving assets and organizing.
	 */

	app.controller('mediaCtrl', function ($scope, $http, $timeout) {

		$http.get('/asset/images').success(function(data){
			$scope.list = data;
			$scope.entryLimit = $scope.list.length;
			$scope.filteredItems = $scope.list.length;
			$scope.totalItems = $scope.list.length;
		});

		$scope.setPage = function(pageNo) {
			$scope.currentPage = pageNo;
		};

		$scope.filter = function() {
				$scope.filteredItems = $scope.filtered.length;
		};

		$scope.sort_by = function(predicate) {
			$scope.predicate = predicate;
			$scope.reverse = !$scope.reverse;
		};

	});

	/**
	 * Controller for Beam Manager retrieving beams and organizing.
	 */

	app.controller('beamCtrl', function ($scope, $http, $timeout) {
		$http.get('/filter/beams').success(function(data) {
			$scope.list = data;
			$scope.entryLimit = $scope.list.length;
			$scope.filteredItems = $scope.list.length;
			$scope.totalItems = $scope.list.length;

	  	});

	  	$scope.previewBeam = function(id){
	  		$scope.preview = '<div id="example_link_1">' + $scope.elements.content + '</div>';
	  	};



	  	$scope.setPage = function(pageNo) {
			$scope.currentPage = pageNo;
		};

		$scope.filter = function() {
			$scope.filteredItems = $scope.filtered.length;
		};

	});

})();