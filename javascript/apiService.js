app.service('apiService', function($http){
        var self = this;
        self.googleMapsApiCall = function(url){
        $.ajax({
            dataType: 'json',
            method: 'POST',
            url: url,
            success: function(response){

                var lat = response.results[0].geometry.location.lat;
                var lng = response.results[0].geometry.location.lng;
                console.log('lat', lat);
                console.log('lng', lng);
                //after we get a response back, grab the coordinates, store in variables, and plug into maps and pano
                var map = new google.maps.Map( $('#map')[0], {center: {lat: lat, lng: lng}, zoom: 14} );
                var panorama = new google.maps.StreetViewPanorama($('#pano')[0], {position: {lat: lat, lng: lng}, pov: {heading: 34, pitch: 10}});
                map.setStreetView(panorama);
            },
            error: function(response){

            }
        });
    };

    self.zillowGetZPID = function(url){  //gets property id form zillow, takes the custom url as a paremter, returns the zpid of the property
        var zpid = null;
        $.ajax({
            method: 'POST',
            crossDomain: true,
            url: url,
            success: function(response){
                var newResponse = xmlToJson(response);
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


            },
            error: function(response){
                var newResponse = xmlToJson(response);
                console.log(newResponse);
            }
        });
    };

    self.zillowGetPropInfo = function(zpid){
        var $div = null;
        var $img = null;
        var $listIndicator = null;
        $.ajax({
            method: 'POST',
            crossDomain: true,
            url: "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&zpid=" + zpid,
            success: function(response){
                var newResponse = xmlToJson(response);
                console.log(newResponse);
                var imageArray = newResponse['UpdatedPropertyDetails:updatedPropertyDetails']['response']['images']['image']['url'];

                console.log('images array ', imageArray);
                for(var i = 0; i < imageArray.length; i++){
                    $listIndicator = $('<li>').attr('data-target', '#myCarousel').attr('data-slide-to', i);
                    var src = imageArray[i]['#text'];

                    $img = $('<img>').attr('src', src).css({width: '100%', height: '100%'});
                    $div = $('<div>').css({height: '100%'}).append($img);
                    if(i===0){
                        $listIndicator.addClass('active');
                        $div.addClass('item active');
                    }else{
                        $div.addClass('item');
                    }
                    //append list item and images to dom
                    $('.carousel-indicators').append($listIndicator);
                    $('.carousel-inner').append($div);
                    //$('#myCarousel').attr('data-ride', 'carousel').carousel({interval: 1000});
                    //$('#myCarousel').carousel('cycle');
                }

                $('#myCarousel').attr('data-ride', 'carousel');
            },
            error: function(response){
                var newResponse = xmlToJson(response);

            }
        });
    };

});