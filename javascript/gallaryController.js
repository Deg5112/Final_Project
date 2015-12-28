//TODO need to finish this
app.controller('galleryController', function(apiService){
   var self = this;
    self.interval = 3000;

    self.returnArray = function(){
        console.log(apiService.imgArray);
        return apiService.imgArray;
    };
});

