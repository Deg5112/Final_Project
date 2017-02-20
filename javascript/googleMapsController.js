// app.controller('googleMapsController', function(apiService){  //handles small maps
//     var self = this;
//     self.fullMap = null;
//     self.panorama = null;
//     self.fullMap = null;
//
//
//     self.mapInitSmall = function(){
//         var mapOptions = apiService.mapOptions; //apiService.mapOptions;
//         var map = new google.maps.Map($('#map')[0], mapOptions);
//
//         var panoOptions = apiService.panoOptions;
//         self.panorama = new google.maps.StreetViewPanorama($('#pano')[0], panoOptions);
//         self.map.setStreetView(self.panorama);
//     };
//
//     self.mapInitSmall();
//
// });
//
// app.controller('googleMapsControllerFull', function(apiService, $scope){  //separate controller for each full
//     var self = this;
//
//     self.mapInitFull = function(){
//
//         var mapOptions = apiService.mapOptions; //apiService.mapOptions;
//
//         self.fullMap = new google.maps.Map($('#map2')[0], mapOptions);
//     };
//
//     self.mapInitFull();
// });
//
// app.controller('googlePanoControllerFull', function(apiService, $scope){
//     var self = this;
//     self.message= 'whatup';
//
//     self.panoInitFull = function(){
//         var panoOptions =  apiService.panoOptions;
//         var panorama = new google.maps.StreetViewPanorama($('#pano2')[0], panoOptions);
//         console.log('panoooo!!!', self.panorama, 'typeofff', typeof self.panorama);
//         self.fullMap.setStreetView(panorama);
//     };
//
//     self.panoInitFull();
//
// });