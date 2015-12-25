//TODO need to finish this
app.controller('galleryController', function(apiService, $scope){
   var self = this;
    self.interval = 20000;

    self.returnArray = function(){
        return apiService.imgArray;
    };
});

