
var app = angular.module('azazel', []);

app.controller('blogController', function($scope) {
        $scope.form = [
            {
                "index": "title",
                "label": "Title",
                "format": "text",
                "required": true,
                "maxlength": 140
            },
            {
                "index": "date",
                "label": "Date",
                "format": "datetime",
                "required": true
            }
        ];
});

