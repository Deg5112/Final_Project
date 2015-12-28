app.controller('savedController', function($scope, apiService, urlCreationService, xmlToJsonService, getIdFromZillowService){
    var self = this;
    self.titleChange = null;
    self.serverErrorMessage = null;
    self.savedApartments = [];

    self.getSavedApartments = function(){
        console.log('savedController hit')
        apiService.getApartments().then(function(response){

            if(response.data.success){
                console.log(response);

                for(var i = 0; i<response.data.data.length; i++){
                    var apartment = {
                       title : response.data.data[i].title,
                        comments : response.data.data[i].comments,
                        searchQuery : {
                            street: response.data.data[i].street,
                            city: response.data.data[i].city ,
                                state: response.data.data[i].state
                        }
                    };
                    self.savedApartments.push(apartment);
                }
            }else{

            }

        }, function(response){
            self.serverErrorMessage = response.error[0] + ' server error please try again';
        });
    };

    self.getSavedApartments();

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
            return self.savedApartments[i].title;
        }else{
            return self.titleChange;
        }
    };

    self.switchView = function(index){
        var street = self.savedApartments[index].searchQuery.street;
        var city = self.savedApartments[index].searchQuery.city;
        var state = self.savedApartments[index].searchQuery.state;

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
