app.service('urlCreationService', function($q){
    var self = this;
    self.createGoogleGeoCodeUrl = function(street, city, state){
        var defer = $q.defer();
        //regex for street number, [1-9]*
        var finalStreetNumber = null;
        var valueName = null;
        var cityName = null;

        var streetNumber = street.match(/[0-9]*/);
        finalStreetNumber = streetNumber[0] + '+';  //914+
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
            cityName = cityArray[0] + ',+';
            finalStreetNumber = finalStreetNumber + cityName;
        }

        finalStreetNumber = finalStreetNumber + state;

        var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + finalStreetNumber + "&key=AIzaSyCw2V4UgzW-dgs_QlZQEezbLaHlAswx1o0";

        defer.resolve(url);
        return defer.promise;
    };


    //zillow
    self.zillowIDUrl = function(street, city, state){
        var defer = $q.defer();
        var finalStreetNumber = null;
        var valueName = null;
        var cityName = '';

        var streetNumber = street.match(/[0-9]*/);
        var finalStreetNumber = streetNumber[0] + '+';  //914+
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

        var url = "http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3" + "&address="+finalStreetNumber+ "citystatezip=" +cityName+ "%2C+" + state;
        defer.resolve(url);
        return defer.promise;

    };
});
