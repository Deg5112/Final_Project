app.service('apiService', function($http, xmlToJsonService){
    //["$http", "xmlToJsonService", "$scope",

        var self = this;
        self.imgArray = [];
        self.googleMapsApiCall = function(url) {
            $http({
                url: url,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST'
            }).then(function (response) {
                var lat = response['data']['results'][0]['geometry']['location']['lat'];
                var lng = response['data'].results[0].geometry.location.lng;

                //after we get a response back, grab the coordinates, store in variables, and plug into maps and pano
                var map = new google.maps.Map($('#map')[0], {center: {lat: lat, lng: lng}, zoom: 14});
                var panorama = new google.maps.StreetViewPanorama($('#pano')[0], {
                    position: {lat: lat, lng: lng},
                    pov: {heading: 34, pitch: 10}
                });
                map.setStreetView(panorama);
            }, function(response){
                console.log('failed');
            });
        };


    self.zillowGetZPID_XML = function(url){  //gets property id form zillow, takes the custom url as a paremter, returns the zpid of the property
        var zpid = null;
        return $http({
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST'
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
        var $div = null;
        var $img = null;
        var $listIndicator = null;

        return $http({
            url: "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&zpid=" + zpid,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST'
        }).then(function(response) {
            var xmlObject = $.parseXML(response.data);
            var newResponse = xmlToJsonService.xmlToJson(xmlObject);
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
                return self.imgArray;
                //console.log(self.imgArray);
                //div we can worry about later
                //$('#myCarousel').attr('data-ride', 'carousel');
            });
        };
});

