$(document).ready(function() {
    $('.carousel').carousel('pause');
});
var app = angular.module('apartmentShark', ['ui.bootstrap', 'ngRoute', 'ngAnimate']);

app.config(function($routeProvider){
   $routeProvider
       .when('/', {templateUrl:'home.html'})
       .when('/zillowStatsFull', {templateUrl: 'zillowFull.html'})
       .when('/galleryFull', {templateUrl: 'galleryFull.html'})
       .when('/mapsFull', {templateUrl: 'mapsFull.html', controller: 'googleMapsControllerFull'})
       .when('/panoFull', {templateUrl: 'panoFull.html', controller: 'googlePanoControllerFull'})
       .otherwise({
           redirectTo: '/'
       });
});

app.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.useXDomain = true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
}

]);

