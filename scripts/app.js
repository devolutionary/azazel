
var app = angular.module('azazel', [
    'ngRoute',
    'azazelControllers'
]);

app.confg(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
            when('/article', {
                templateUrl: 'templates/article.small.html',
                controller: 'blogController'
            });
    }
]);

var azazelControllers = angular.module('azazelControllers', []);

azazelControllers.controller('blogController', ['$scope', '$http',
    function ($scope,$http) {

    }
]);
