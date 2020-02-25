app.service('apiService', function($http, xmlToJsonService){
    var self = this;
    self.imgArray = [];
    self.facts = null;
    self.mapOptions = null;
    self.panoOptions = null;
    self.map = null;
    self.panorama = null;
    self.savedApartments = [];
    self.savedBool = null;
    self.noResultsBool = false;
    self.searchMessage = null;
    self.loadingStatus = true;

    self.getLoadingStatus = function() {
        return self.loadingStatus;
    };

    self.getFacts = function () {
        return self.facts;
    };

    self.getNoResultsBool = function () {
        return self.noResultsBool;
    };

    self.apiUpdateCommentsInDB = function(comments, index){
        var rowId = self.savedApartments[index].rowId;

        var data = 'comments='+comments+'&rowId='+rowId;
        $http({
            url: "/php/updateComments.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            data: data
        }).then(function(response){
           if(response.data.success){
               console.log(response);
           }else{
               console.log(response);
           }
        }, function(response){
            console.log('COMMENTS SERVER ERROR');
        });
    };

    self.removeApartment = function(userId, index){
        if(userId !== 0){
            var rowId = self.savedApartments[index].rowId;

            var data = 'userId='+userId+'&rowId='+rowId;
            $http({
                url: "/php/removeApartment.php",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST',
                data: data
            }).then(function(response){
                if(response.data.success){
                    self.savedApartments.splice(index, 1);
                    console.log(response);
                }else{
                    console.log('remove operation failed');
                }
            }, function(response){
                console.log('server error');
            });
        }else{
            self.savedApartments.splice(index, 1);
        }

    };

    self.updateAptTitleInDB = function(title, index){
      var rowId = self.savedApartments[index].rowId;
        console.log('TITLE', title);
        console.log('ROWID', rowId);
        var data = 'title='+title+'&rowId='+rowId;
        return $http({
            url: "/php/update.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            data: data
        });
    };

    self.updateApartmentInDb = function(street, city, state, userId){
            if(userId !== 0){
                var data = 'street='+street+'&city='+city+'&state='+state+'&userId='+userId;

                $http({
                    url: "/php/addApartment.php",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    method: 'POST',
                    data: data
                }).then(function(response) {
                    if (response.data.success) {

                        var apartment = {
                            title: street,
                            comments: null,
                            searchQuery: {street: street, city: city, state: state},
                            rowId: response.data.rowId
                        };

                        self.savedApartments.unshift(apartment);
                        //console.log(self.savedApartments);
                    }
                }, function(response){

                });
            }
            else{
                var apartment = {
                    title: street,
                    comments: null,
                    searchQuery: {street: street, city: city, state: state},
                };
                self.savedApartments.unshift(apartment);
            }
        };

        //sends request to server to fetch saved apartments
        self.getApartments = function(userId){
                console.log('apiServiceHit!');
            console.log('USERID', userId);

                var data = 'userId='+ userId;

            $http({
                url: "/php/getSavedApartments.php",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST',
                data: data
            }).then(function(response){
                console.log(response);
                 if(response.data.success){

                     self.savedBool = false;
                     self.savedApartments = [];
                     for(var i = 0; i<response.data.data.length; i++){
                         var apartment = {
                             title : response.data.data[i].title,
                             comments : response.data.data[i].comments,
                             searchQuery : {
                                 street: response.data.data[i].street,
                                 city: response.data.data[i].city ,
                                 state: response.data.data[i].state
                             },
                             rowId: response.data.data[i].id
                         };
                         self.savedApartments.push(apartment);
                     }

                 }else{
                     self.savedApartments = [];
                     self.savedBool = true;
                 }

             }, function(response){
                 self.serverErrorMessage = response.error[0] + ' server error please try again';
             });
        };

        self.googleMapsApiCall = function(url) {
            $http({
                url: url,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST'
            }).then(function (response) {
                var lat = response['data']['results'][0]['geometry']['location']['lat'];
                var lng = response['data'].results[0].geometry.location.lng;

                //after we get a response back, grab the coordinates, store in variables, and plug into maps and pano
                //first store the options on as a property in the service
                self.mapOptions = {center: {lat: lat, lng: lng}, zoom: 14};
                self.panoOptions = { position: {lat: lat, lng: lng}, pov: {heading: 34, pitch: 10} };
                //maps creation
                self.map = new google.maps.Map($('#map')[0], self.mapOptions);
                //pano creation
                self.panorama = new google.maps.StreetViewPanorama($('#pano')[0], self.panoOptions);

                //var map2 = new google.maps.Map($('#pano')[0], self.mapOptions);
                //var panorama2 = new google.maps.StreetViewPanorama($('#pano2')[0], self.panoOptions);
                // map.setStreetView(panorama);
                //map2.setStreetView(panorama2);
            }, function(response){
                console.log('failed');
            });
        };


    self.zillowGetZPID_XML = function(url){  //gets property id form zillow, takes the custom url as a paremter, returns the zpid of the property
        var urlToSend = $.param( {url: url} );
        var zpid = null;
         return $http({
            url: '/php/zillow.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            data: urlToSend
        }).then(function(response) {
            //return the xml string /object as a string
            return response;

        }, function(response){
            return response;
            //var newResponse = xmlToJson(response);
            //console.log(newResponse);
        });
    };

    self.zillowGetPropInfo = function(zpid){
        self.imgArray = [];
        var $div = null;
        var $img = null;
        var $listIndicator = null;
        var url = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zpid="+zpid
        var urlToSend = $.param( {url: url} );
        return $http({
            url: "/php/zillowGetPropInfo.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            data: urlToSend
        }).then(function(response) {
            console.log(response);

            var xmlObject = $.parseXML(response.data.data);
            var newResponse = xmlToJsonService.xmlToJson(xmlObject);

            console.log(newResponse);

            var imageArray = newResponse['UpdatedPropertyDetails:updatedPropertyDetails']['response']['images']['image']['url'];

                for(var i = 0; i < imageArray.length; i++){
                    $listIndicator = $('<li>').attr('data-target', '#myCarousel').attr('data-slide-to', i);
                    var src = imageArray[i];
                    //$scope.srcArray.push(src);
                    var imgObj = {};
                    //$img = $('<img>')  .attr('src', src).css({width: '100%', height: '100%'});
                    //$div = $('<div>')  .css({height: '100%'}).append($img);
                    imgObj.src=src;

                    if(i===0){
                        imgObj.listIndicatorClass = 'active';
                        imgObj.divClass='item active';
                    }else{
                        imgObj.divClass='item';
                        //$div.addClass('item');
                    }

                    self.imgArray.push(imgObj);
                    //append list item and images to dom
                }
            var factsObject = newResponse['UpdatedPropertyDetails:updatedPropertyDetails']['response']['editedFacts'];
            delete factsObject.useCode;
            self.facts = factsObject;
            return;

        });
      };
});

