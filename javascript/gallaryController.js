
app.controller('galleryController', function(apiService){
   var self = this;
    self.interval = 20000;

    self.returnArray = function(){
        return apiService.imgArray;
    };
});

