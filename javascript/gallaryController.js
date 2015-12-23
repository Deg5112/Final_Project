//TODO need to finish this
app.controller('galleryController', function(apiService){
   var self = this;
    self.array=[];
    self.returnArray = function(){

        self.array = apiService.imgArray;
        console.log(self.array);
        return apiService.imgArray;
    };
});