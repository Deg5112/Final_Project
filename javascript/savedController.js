app.controller('savedController', function($scope, apiService, urlCreationService, xmlToJsonService, getIdFromZillowService, modalService, loginRegisterService){
    var self = this;
    self.titleChange = null;
    self.serverErrorMessage = null;

    self.updateModalBool = function(){
        modalService.modalBool = false;
    };

    self.getModal = function(){
      return modalService.returnModalBool();
    };

    self.returnSavedBool = function(){
      return apiService.savedBool;
    };


    self.returnSavedApartments = function(){
      return apiService.savedApartments;
    };

    //self.getSavedApartments = function() {
    //    console.log('savedController hit');
    //    apiService.getApartments();
    //};
    //
    //self.getSavedApartments();

    //self.savedApartments = [
    //    {title: 'seaview summit', comments: 'hello governer!', searchQuery: {street: '102 Calais St', city: 'Laguna Niguel', state: 'CA'}},
    //    {title: 'Huntington Vista', comments: 'hello governer!', searchQuery: {street: '21551 Brookhurst St', city: 'Huntington Beach', state: 'CA'}},
    //    {title: 'Laguna Condo', comments: 'hello governer!', searchQuery: {street: '234 Cliff Dr', city: 'Laguna Beach', state: 'CA'}},
    //    {title: 'Monarch Coast', comments: 'hello governer!', searchQuery: {street: '32400 Crown Valley Pkwy', city: 'Dana point', state: 'CA'}}
    //];

    self.updateTitleInDB = function(title, index){
        apiService.updateAptTitleInDB();
    };

    self.returnTitle = function(i){
        if(self.titleChange === null){
            return apiService.savedApartments[i].title;
        }else{
            var title = apiService.savedApartments;
            console.log(title);
            return title;
        }
    };

    self.switchView = function(index){
        modalService.modalBool = false;

        var street = apiService.savedApartments[index].searchQuery.street;
        var city = apiService.savedApartments[index].searchQuery.city;
        var state = apiService.savedApartments[index].searchQuery.state;

        console.log(street, city, state);

        urlCreationService.createGoogleGeoCodeUrl(street, city, state).then(function(response){
            apiService.googleMapsApiCall(response);
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
