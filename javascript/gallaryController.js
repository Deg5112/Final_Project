
app.controller('galleryController', function(apiService){
   var self = this;
    self.interval = 3000;

    self.returnArray = function(){

        return apiService.imgArray;
    };
});

