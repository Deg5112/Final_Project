app.directive('resizeAttr', function ($window) {
    return function (scope, element) { //some functions actually take scope as a parameter so no need to include dependecy injection scopes..
        var w = angular.element($window);
        scope.getWindowDimensions = function () {
            return {
                'h': w.height(),
                'w': window.innerWidth
            };
        };

        scope.$watch(scope.getWindowDimensions, function (newValue, oldValue) {

            scope.windowHeight = newValue.h;
            scope.windowWidth = newValue.w;
            console.log(newValue.w);

            scope.style = function () {
                return {
                    'height': (newValue.h - 100) + 'px',
                    'width': (newValue.w - 100) + 'px'
                };
            };

        }, true);

        w.bind('resize DOMContentLoaded', function () {
            scope.$apply();
        });

    };
});

app.directive('disableAnimation', function($animate){
    return {
        restrict: 'A',
        link: function($scope, $element, $attrs){
            $attrs.$observe('disableAnimation', function(value){
                $animate.enabled(!value, $element);
            });
        }
    };
});


