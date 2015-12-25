app.controller('googleMapsController', function(apiService){
    var self = this;
    self.name = 'asdfsd';
    self.map = null;
    self.pano = null;

    self.mapInitSmall = function(){
        console.log('map Init Full running!');
        var mapOptions = {center: {lat: 33.5060991, lng: -117.7337519}, zoom: 14}; //apiService.mapOptions;
        console.log(mapOptions);
        //var map = new google.maps.Map($('#map')[0], mapOptions);
        var map = new google.maps.Map($('#map')[0], mapOptions);
        self.map = map;

        var panoOptions = { position: {lat: 33.5060991, lng: -117.7337519}, pov: {heading: 34, pitch: 10} };
        self.panorama = new google.maps.StreetViewPanorama($('#pano')[0], panoOptions);
        self.map.setStreetView(self.panorama);
    };


    self.mapInitSmall();

});

app.controller('googleMapsControllerFull', function(apiService){
    var self = this;
    self.name = 'asdfsd';

    self.mapInitFull = function(){
        console.log('map Init Full running!');
        var mapOptions = {center: {lat: 33.5060991, lng: -117.7337519}, zoom: 14}; //apiService.mapOptions;
        console.log(mapOptions);
        //var map = new google.maps.Map($('#map')[0], mapOptions);
        var map2 = new google.maps.Map($('#map2')[0], mapOptions);

    };

    self.mapInitFull();


});