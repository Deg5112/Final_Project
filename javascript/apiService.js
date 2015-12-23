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
            return response;

        }, function(response){
            return response;
            //var newResponse = xmlToJson(response);
            //console.log(newResponse);
        });

            //var newResponse = xmlToJson(response);
            var result = newResponse['SearchResults:searchresults']['response']['results']['result'];
            console.log('typeof result', typeof result);
            if(!(Array.isArray(result)) ){
                console.log('object!');
                zpid = result['zpid']['#text'];
                console.log('zillow id' + ' ' + zpid);
                zillowGetPropInfo(zpid);
                return;
            }
            if( Array.isArray(result) ) {
                console.log('array!');
                console.log(result);
                for(var i = 0; i < result.length; i++){
                    zpid = result[i]['zpid']['#text'];
                    console.log('zillow id' + ' ' + zpid);
                    zillowGetPropInfo(zpid);
                }
            }
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
                    //$('.carousel-indicators').append($listIndicator);
                    //$('.carousel-inner').append($div);
                    //$('#myCarousel').attr('data-ride', 'carousel').carousel({interval: 1000});
                    //$('#myCarousel').carousel('cycle');
                }
                console.log(self.imgArray);
                //div we can worry about later
                $('#myCarousel').attr('data-ride', 'carousel');
            });
        };
});

        //$.ajax({
        //    method: 'POST',
        //    crossDomain: true,
        //    url: "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&zpid=" + zpid,
        //    success: function(response){
        //        var newResponse = xmlToJson(response);
        //        console.log(newResponse);
        //        var imageArray = newResponse['UpdatedPropertyDetails:updatedPropertyDetails']['response']['images']['image']['url'];
        //
        //        console.log('images array ', imageArray);
        //        for(var i = 0; i < imageArray.length; i++){
        //            $listIndicator = $('<li>').attr('data-target', '#myCarousel').attr('data-slide-to', i);
        //            var src = imageArray[i]['#text'];
        //
        //            $img = $('<img>').attr('src', src).css({width: '100%', height: '100%'});
        //            $div = $('<div>').css({height: '100%'}).append($img);
        //            if(i===0){
        //                $listIndicator.addClass('active');
        //                $div.addClass('item active');
        //            }else{
        //                $div.addClass('item');
        //            }
        //            //append list item and images to dom
        //            $('.carousel-indicators').append($listIndicator);
        //            $('.carousel-inner').append($div);
        //            //$('#myCarousel').attr('data-ride', 'carousel').carousel({interval: 1000});
        //            //$('#myCarousel').carousel('cycle');
        //        }
        //
        //        $('#myCarousel').attr('data-ride', 'carousel');
        //    },
            //error: function(response){
            //    var newResponse = xmlToJson(response);
            //
            //}
