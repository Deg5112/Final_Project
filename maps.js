// get coordinates
//give panels a title?

$(function(){

    //event listener for form button
    $('.btn').click(function(){
        var street = $('#street').val();
        var city = $('#city').val();
        var state = $('#state').val();
        createGoogleGeoCodeUrl(street, city, state);
        zillowIDUrl(street, city, state);
    });
});


//converts address into custom url for google
function createGoogleGeoCodeUrl(street, city, state, zip){
    //regex for street number, [1-9]*
    var finalStreetNumber = null;
    var valueName = null;
    var cityName = null;

   var streetNumber = street.match(/[0-9]*/);
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

    finalStreetNumber = finalStreetNumber + state;

    var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + finalStreetNumber + "&key=AIzaSyAj4QUN4KwWkF8CtACrJ5Cc_YUmjyzCksA";

    googleMapsApiCall(url);
}

function googleMapsApiCall(url){
    $.ajax({
        dataType: 'json',
        method: 'POST',
        url: url,
        success: function(response){

            var lat = response.results[0].geometry.location.lat;
            var lng = response.results[0].geometry.location.lng;

            //after we get a response back, grab the coordinates, store in variables, and plug into maps and pano
            var map = new google.maps.Map( $('#map')[0], {center: {lat: lat, lng: lng}, zoom: 14} );
            var panorama = new google.maps.StreetViewPanorama($('#pano')[0], {position: {lat: lat, lng: lng}, pov: {heading: 34, pitch: 10}});
            map.setStreetView(panorama);
        },
        error: function(response){

        }
    });
}



//converts xml to json so you can work with the zillow data
function zillowIDUrl(street, city, state){

    var finalStreetNumber = null;
    var valueName = null;
    var cityName = '';

    var streetNumber = street.match(/[0-9]*/);
    var finalStreetNumber = streetNumber[0] + '+';  //914+
    console.log('street number ', finalStreetNumber);
    //regex for name [a-zA-Z]*
    var streetNameArray = street.match(/[a-zA-Z]+/g);

    if(streetNameArray.length>0){  //if more than one in the array concatenate all to the number with a +
        for(var i = 0; i<streetNameArray.length; i++){

            if(i === streetNameArray.length-1){
                valueName = streetNameArray[i] + '&';
                finalStreetNumber = finalStreetNumber + valueName;
            }else{
                valueName = streetNameArray[i] + '+';
                finalStreetNumber = finalStreetNumber + valueName;  //123+fake+st
            }
        }
    }else{
        var newValueName = streetNameArray[0] + '&';
        finalStreetNumber = finalStreetNumber + newValueName;
    }

//
//city concat
    var cityArray = city.match(/[a-zA-Z]+/g);
    if(cityArray.length>0){  //if more than one in the array concatenate all to the number with a +
        for(var x = 0; x<cityArray.length; x++){
            if(x === cityArray.length-1){  //is it the last?
                cityName = cityName + cityArray[x];

            }else{
                cityName = cityName + cityArray[x] + '+';

            }
        }
    }else{
        cityName = cityArray[0];
    }

    //"http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&" + "address=" 2114+Bigelow+Ave&citystatezip=Seattle%2C+WA"

    var url = "http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&" + "address="+finalStreetNumber+ "citystatezip=" +cityName+ "%2C+" + state;
        console.log('end url ', url);

    zillowGetZPID(url);
}

function zillowGetZPID(url){  //gets property id form zillow, takes the custom url as a paremter, returns the zpid of the property
    $.ajax({
       method: 'POST',
        crossDomain: true,
        url: url,
        success: function(response){
           var newResponse = xmlToJson(response);
            console.log(newResponse);
            var zpid = newResponse['SearchResults:searchresults']['response']['results']['result']['zpid']['#text'];
            console.log('zillow id' + ' ' + zpid);
            zillowGetPropInfo(zpid);

        },
        error: function(response){
            var newResponse = xmlToJson(response);
            console.log(newResponse);
        }
    });
}


function zillowGetPropInfo(zpid){
    var $div = null;
    var $img = null;
    var $listIndicator = null;
    $.ajax({
        method: 'POST',
        crossDomain: true,
        url: "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&zpid=" + zpid,
        success: function(response){
            var newResponse = xmlToJson(response);
            var imageArray = newResponse['UpdatedPropertyDetails:updatedPropertyDetails']['response']['images']['image']['url'];

            console.log(imageArray);
            for(var i = 0; i < imageArray.length; i++){
                $listIndicator = $('<li>').attr('data-target', '#myCarousel').attr('data-slide-to', i);
                var src = imageArray[i]['#text'];
                console.log(src);
                $img = $('<img>').attr('src', src).css({width: '100%', height: '100%'});
                $div = $('<div>').css({height: '100%'}).append($img);
                if(i===0){
                    $listIndicator.addClass('active');
                    $div.addClass('item active');
                }else{
                    $div.addClass('item');
                }
                //append list item and images to dom
                console.log($div[0]);
                console.log($listIndicator[0]);
                $('.carousel-indicators').append($listIndicator);
                $('.carousel-inner').append($div);
                //$('#myCarousel').attr('data-ride', 'carousel').carousel({interval: 1000});
                //$('#myCarousel').carousel('cycle');
            }
            console.log($('#myCarousel'));
            $('#myCarousel').attr('data-ride', 'carousel');
        },
        error: function(response){
            var newResponse = xmlToJson(response);
            console.log(newResponse);
        }
    });
}




function xmlToJson(xml) {

    // Create the return object
    var obj = {};

    if (xml.nodeType == 1) { // element
        // do attributes
        if (xml.attributes.length > 0) {
            obj["@attributes"] = {};
            for (var j = 0; j < xml.attributes.length; j++) {
                var attribute = xml.attributes.item(j);
                obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
            }
        }
    } else if (xml.nodeType == 3) { // text
        obj = xml.nodeValue;
    }

    // do children
    if (xml.hasChildNodes()) {
        for(var i = 0; i < xml.childNodes.length; i++) {
            var item = xml.childNodes.item(i);
            var nodeName = item.nodeName;
            if (typeof(obj[nodeName]) == "undefined") {
                obj[nodeName] = xmlToJson(item);
            } else {
                if (typeof(obj[nodeName].push) == "undefined") {
                    var old = obj[nodeName];
                    obj[nodeName] = [];
                    obj[nodeName].push(old);
                }
                obj[nodeName].push(xmlToJson(item));
            }
        }
    }
    return obj;
};





