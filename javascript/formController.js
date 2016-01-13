app.controller('formController',  function($scope, apiService, urlCreationService, xmlToJsonService, getIdFromZillowService, modalService){
    var self = this;
    self.currentFormInput = {};
    //search method on this controller uses the url services to return a promise value that's used to call the api's service for maps and zillow
    self.search = function(street, city, state){
        modalService.modalBool = false;
        urlCreationService.createGoogleGeoCodeUrl(street, city, state).then(function(response){

            apiService.googleMapsApiCall(response);
            apiService.updateApartmentInDb(street, city, state);
        });

        //get url, then convert xml response to json, then get the property id, then
        urlCreationService.zillowIDUrl(street, city, state).then(function(response){//get url
            apiService.zillowGetZPID_XML(response).then(function(response){
                //below converts xml string to object, we have the xml string

                var xmlObject = $.parseXML(response.data.data);

               //below coverts xml to json
                var newResponse = xmlToJsonService.xmlToJson(xmlObject);

                var id = getIdFromZillowService.zillowGetIdFromResponse(newResponse);
                    console.log(id);
                    //get this FAR!

                //console.log(id);
                apiService.zillowGetPropInfo(id).then(function(response){
                    $scope.imgArray = response;
                });
            });
        });
    };
});

