app.service('apiService', function($http, xmlToJsonService){
        var self = this;
        self.imgArray = [];
        self.facts = [];
        self.mapOptions = null;
        self.panoOptions = null;
        self.map = null;
        self.panorama = null;
        self.savedApartments = [];

        self.updateApartmentInDb = function(street, city, state){
            console.log('UPDATING!!');
            var data = 'street='+street+'&city='+city+'&state='+state;

            $http({
                url: "http://localhost:8888/lfz/Final_Project/php/addApartment.php",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST',
                data: data
            }).then(function(response) {
                console.log('ADD RESPONSE', response);
                if (response.data.success) {

                    var apartment = {
                        title: street,
                        comments: null,
                        searchQuery: {street: street, city: city, state: state}
                    };

                    self.savedApartments.unshift(apartment);
                    console.log(self.savedApartments);
                }
            }, function(response){

            });
        };

        //sends request to server to fetch saved apartments
        self.getApartments = function(userId){
                var data = 'userId='+ userId;
            console.log('GETAPARTMENTS HIT', data);

            $http({
                url: "http://localhost:8888/lfz/Final_Project/php/getSavedApartments.php",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST',
                data: data
            }).then(function(response){
                 if(response.data.success){
                     console.log(response);
                     self.savedApartments = [];
                     for(var i = 0; i<response.data.data.length; i++){
                         var apartment = {
                             title : response.data.data[i].title,
                             comments : response.data.data[i].comments,
                             searchQuery : {
                                 street: response.data.data[i].street,
                                 city: response.data.data[i].city ,
                                 state: response.data.data[i].state
                             }
                         };
                         self.savedApartments.push(apartment);
                     }
                 }else{

                 }

             }, function(response){
                 self.serverErrorMessage = response.error[0] + ' server error please try again';
             });
        };

        self.updateAptTitleInDB = function(){
          //TODO update the title in the database
        };


        self.googleMapsApiCall = function(url) {
            $http({
                url: url,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST'
            }).then(function (response) {
                var lat = response['data']['results'][0]['geometry']['location']['lat'];
                var lng = response['data'].results[0].geometry.location.lng;

                //after we get a response back, grab the coordinates, store in variables, and plug into maps and pano
                //first store the options on as a property in the service
                self.mapOptions = {center: {lat: lat, lng: lng}, zoom: 14};
                self.panoOptions = { position: {lat: lat, lng: lng}, pov: {heading: 34, pitch: 10} };
                //maps creation
                self.map = new google.maps.Map($('#map')[0], self.mapOptions);
                //pano creation
                self.panorama = new google.maps.StreetViewPanorama($('#pano')[0], self.panoOptions);

                //var map2 = new google.maps.Map($('#pano')[0], self.mapOptions);
                //var panorama2 = new google.maps.StreetViewPanorama($('#pano2')[0], self.panoOptions);
                map.setStreetView(panorama);
                //map2.setStreetView(panorama2);
            }, function(response){
                console.log('failed');
            });
        };


    self.zillowGetZPID_XML = function(url){  //gets property id form zillow, takes the custom url as a paremter, returns the zpid of the property
        var urlToSend = $.param( {url: url} );
        var zpid = null;
         return $http({
            url: 'http://localhost:8888/lfz/Final_Project/php/zillow.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            data: urlToSend
        }).then(function(response) {
            //return the xml string /object as a string
            return response;

        }, function(response){
            return response;
            //var newResponse = xmlToJson(response);
            //console.log(newResponse);
        });
    };

    self.zillowGetPropInfo = function(zpid){
        self.imgArray = [];
        var $div = null;
        var $img = null;
        var $listIndicator = null;
        var url = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&zpid=" + zpid;
        var urlToSend = $.param( {url: url} );
        return $http({
            url: "http://localhost:8888/lfz/Final_Project/php/zillowGetPropInfo.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            data: urlToSend
        }).then(function(response) {
            console.log(response);

            var xmlObject = $.parseXML(response.data.data);
            var newResponse = xmlToJsonService.xmlToJson(xmlObject);

            console.log(newResponse);

            var imageArray = newResponse['UpdatedPropertyDetails:updatedPropertyDetails']['response']['images']['image']['url'];

                for(var i = 0; i < imageArray.length; i++){
                    $listIndicator = $('<li>').attr('data-target', '#myCarousel').attr('data-slide-to', i);
                    var src = imageArray[i]['#text'];
                    //$scope.srcArray.push(src);
                    var imgObj = {};
                    //$img = $('<img>')  .attr('src', src).css({width: '100%', height: '100%'});
                    //$div = $('<div>')  .css({height: '100%'}).append($img);
                    imgObj.src=src;

                    if(i===0){
                        imgObj.listIndicatorClass = 'active';
                        imgObj.divClass='item active';
                    }else{
                        imgObj.divClass='item';
                        //$div.addClass('item');
                    }

                    self.imgArray.push(imgObj);
                    //append list item and images to dom
                }
            var factsObject = newResponse['UpdatedPropertyDetails:updatedPropertyDetails']['response']['editedFacts'];
            delete factsObject.useCode;
            self.facts = factsObject;
                return;

            });
        };
});

