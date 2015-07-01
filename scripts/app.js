
var app = angular.module('azazel', [
    'ngRoute',
    'azazelControllers'
]);

var azazelControllers = angular.module('azazelControllers', []);

azazelControllers.controller('blogCtrl', ['$scope', '$http',
    function ($scope,$http) {

    }
]);

azazelControllers.controller('articleCtrl', ['$scope', '$http', '$routeParams',
    function ($scope, $http, $routeParams) {

    }
]);

azazelControllers.controller('articleDetailCtrl', ['$scope', '$http', '$routeParams',
    function ($scope, $http, $routeParams) {
        $scope.articleURL = $routeParams.articleURL;
        $http({
            url: '/rest/index.php',
            method: "POST",
            data: {"controller":"article", "action":"all"}
        }).success(function(data, status, header, config) {
            $scope.data = data;
        }).error(function(data, status, headers, config) {

        });
    }
]);




app.config(['$routeProvider', '$locationProvider',
    function($routeProvider, $locationProvider) {

        if(window.history && window.history.pushState){
            $locationProvider.html5Mode({
                enabled: true,
                requireBase: false
            });
        }

        $routeProvider.when('/article', {
                templateUrl: 'templates/articles.html',
                controller: 'articleCtrl'
            }).when('/article/tag/:tagName', {
                templateUrl: 'templates/articles.html',
                controller: 'articleCtrl'
            }).when('/article/read/:articleURL', {
                templateUrl: 'templates/article-single.html',
                controller: 'articleDetailCtrl'
            }).otherwise({
                redirectTo: '/'
            });

    }
]);
