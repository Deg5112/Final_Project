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
                console.log(response);
               //xmlToJsonService.xmlToJson(response.data);

                });
            });
        };
});

//createGoogleGeoCodeUrl(street, city, state);
//zillowIDUrl(street, city, state);