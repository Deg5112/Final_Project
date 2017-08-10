app.controller('formController',  function($scope, apiService, urlCreationService, xmlToJsonService, getIdFromZillowService, modalService, loginRegisterService){
    var self = this;
    $scope.searchMessage = null;
    $scope.noResultsBool = true;
    self.currentFormInput = {};

    self.returnSearchMessage = function (){
      return apiService.searchMessage ;
    };

    //search method on this controller uses the url services to return a promise value that's used to call the api's service for maps and zillow
    self.search = function(street, city, state){
        console.log('STREET' , street);

        for(var x = 0; x<apiService.savedApartments.length; x++){
            var curStreet = street.toLowerCase();
            var curQueryStreet = apiService.savedApartments[x].searchQuery.street.toLowerCase();
            console.log('query strete',apiService.savedApartments);
            if(curQueryStreet == curStreet){
                console.log(apiService.savedApartments[x].searchQuery.street);
                console.log('MATCH!');
                apiService.searchMessage = 'This Address is Already Saved!';
                return;
            }
        }
        apiService.searchMessage = null;


        modalService.modalBool = false;
        urlCreationService.createGoogleGeoCodeUrl(street, city, state).then(function(response){

            apiService.googleMapsApiCall(response);
            apiService.updateApartmentInDb(street, city, state, loginRegisterService.userId);
        });

        //get url, then convert xml response to json, then get the property id, then
        urlCreationService.zillowIDUrl(street, city, state).then(function(response){//get url
            console.log('response', response);
            apiService.zillowGetZPID_XML(response).then(function(response){
                //below converts xml string to object, we have the xml string
                var xmlObject = $.parseXML(response.data.data);
               //below coverts xml to json
                var newResponse = xmlToJsonService.xmlToJson(xmlObject);
                var id = getIdFromZillowService.zillowGetIdFromResponse(newResponse);
                    console.log('ZPID' , id);
                    //get this FAR!
                if(typeof id === 'undefined'){
                    console.log('UNDEFINNNNEED ID!');
                    //self.noResultsBool = true;
                    apiService.imgArray = [];
                    apiService.facts = null;
                    apiService.noResultsBool = true;
                    return;
                }

                //console.log(id);
                apiService.zillowGetPropInfo(id).then(function(response){
                    apiService.noResultsBool = false;
                    $scope.imgArray = response;
                });
            });
        });
    };

});

