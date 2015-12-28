//TODO need to finish this
app.controller('galleryController', function(apiService){
   var self = this;
    self.interval = 1000;

    self.returnArray = function(){
        console.log(apiService.imgArray);
        return apiService.imgArray;
    };
});

