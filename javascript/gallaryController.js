//TODO need to finish this
app.controller('galleryController', function(apiService){
   var self = this;
    self.returnArray = function(){

        return apiService.imgArray;
    };
});