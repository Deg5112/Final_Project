var app = angular.module('apartmentShark', ['ui.bootstrap', 'ngRoute']);

app.config(function($routeProvider){
   $routeProvider
       .when('/', {templateUrl:'home.html'})
       .when('/zillowStatsFull', {templateUrl: 'zillowFull.html'})
       .when('/galleryFull', {templateUrl: 'galleryFull.html'})
       .when('/mapsFull', {templateUrl: 'mapsFull.html'})
       .when('/panoFull', {templateUrl: 'panoFull.html'})
       .otherwise({
           redirectTo: '/'
       });
});

app.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.useXDomain = true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
}

]);