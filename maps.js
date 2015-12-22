// get coordinates
// api for geocoding   AIzaSyAj4QUN4KwWkF8CtACrJ5Cc_YUmjyzCksA

function getCoordinates(street, city, state, zip){
    //regex for street number, [1-9]*
    var finalStreetNumber = null;
    var valueName = null;
    var cityName = null;

   var streetNumber = street.match(/[1-9]*/);
   var finalStreetNumber = streetNumber[0] + '+';  //914+
    //regex for name [a-zA-Z]*
   var streetNameArray = street.match(/[a-zA-Z]+/g);

    if(streetNameArray.length>0){  //if more than one in the array concatenate all to the number with a +
        for(var i = 0; i<streetNameArray.length; i++){

            if(i === streetNameArray.length-1){
                valueName = streetNameArray[i] + ',+';
                finalStreetNumber = finalStreetNumber + valueName;
            }else{
               valueName = streetNameArray[i] + '+';
                finalStreetNumber = finalStreetNumber + valueName;
            }
        }
    }else{
        var newValueName = streetNameArray[0] + ',+';
        finalStreetNumber = finalStreetNumber + newValueName;
    }



//
//city concat
    var cityArray = city.match(/[a-zA-Z]+/g);
    if(cityArray.length>0){  //if more than one in the array concatenate all to the number with a +
        for(var x = 0; x<cityArray.length; x++){
            if(x === cityArray.length-1){  //is it the last?
                cityName = cityArray[x] + ',+';
                finalStreetNumber = finalStreetNumber + cityName;
            }else{
                cityName = cityArray[x] + '+';
                finalStreetNumber = finalStreetNumber + cityName;
            }
        }
    }else{
        cityName = cityArray[x] + ',+';
        finalStreetNumber = finalStreetNumber + cityName;
    }
    console.log(finalStreetNumber);

    finalStreetNumber = finalStreetNumber + state;





    var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + finalStreetNumber + "&key=AIzaSyAj4QUN4KwWkF8CtACrJ5Cc_YUmjyzCksA";

    $.ajax({
        dataType: 'json',
        method: 'POST',
        url: url,
        success: function(response){
            //console.log(response);
            var lat = response.results[0].geometry.location.lat;
            var lng = response.results[0].geometry.location.lng;
            console.log('type ' + ' ' + typeof lat);

            var map = new google.maps.Map( $('#map')[0], {center: {lat: lat, lng: lng}, zoom: 14} );
            var panorama = new google.maps.StreetViewPanorama($('#pano')[0], {position: {lat: lat, lng: lng}, pov: {heading: 34, pitch: 10}});
            map.setStreetView(panorama);
        },
        error: function(response){
           console.log(response);
        }
    });
}

$(function(){
    $('.btn').click(function(){
        var street = $('#street').val();
        var city = $('#city').val();
        var state = $('#state').val();
        console.log(street, city, state);

        getCoordinates(street, city, state);
    });
});





