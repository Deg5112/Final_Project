app.controller('formController', function(apiService, urlCreationService, xmlToJsonService){
    var self = this;
    self.currentFormInput = {};
    //search method on this controller uses the url services to return a promise value that's used to call the api's service for maps and zillow
    self.search = function(street, city, state){
        urlCreationService.createGoogleGeoCodeUrl(street, city, state).then(function(response){
           apiService.googleMapsApiCall(response);
        });

        //get url, then get the property id, then convert xml response to json, then
        urlCreationService.zillowIDUrl(street, city, state).then(function(response){//get url
            apiService.zillowGetZPID(response).then(function(response){
                console.log(response.data);
                //below converts xml string to object
                var xmlObject = $.parseXML(response.data);
               //below coverts xml to json
                var newResponse = xmlToJsonService.xmlToJson(xmlObject);

                console.log(newResponse);

                //var result = newResponse['SearchResults:searchresults']['response']['results']['result'];
                //console.log('typeof result', typeof result);
                //if(!(Array.isArray(result)) ){
                //    console.log('object!');
                //    zpid = result['zpid']['#text'];
                //    console.log('zillow id' + ' ' + zpid);
                //    zillowGetPropInfo(zpid);
                //    return;
                //}
                //if( Array.isArray(result) ) {
                //    console.log('array!');
                //    console.log(result);
                //    for(var i = 0; i < result.length; i++){
                //        zpid = result[i]['zpid']['#text'];
                //        console.log('zillow id' + ' ' + zpid);
                //        zillowGetPropInfo(zpid);
                //    }
                //}


                });
            });
        };
});

//createGoogleGeoCodeUrl(street, city, state);
//zillowIDUrl(street, city, state);