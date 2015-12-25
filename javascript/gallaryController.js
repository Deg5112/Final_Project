//TODO need to finish this
app.controller('galleryController', function(apiService, $scope){
   var self = this;
    self.interval = 3000;

    self.slides = [
        {image:'images/amanda.jpg'},
        {image:'images/background_silicon.jpg'},
        {image:'images/bighead.jpg'},
        {image:'images/gavin.jpg'},
        {image:'images/dinesh.jpg'}
    ];

    self.returnArray = function(){
        return apiService.imgArray;
    };
});

