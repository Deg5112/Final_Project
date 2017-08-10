app.controller('statsController', function(apiService){
   var self = this;
    self.headerBool = false;

    self.getLoadingStatus = function () {
        return apiService.loadingStatus;
    };

    self.returnNoResultsBool = function(){
      return apiService.getNoResultsBool();
    };

    self.stats = function(){
        for(var i in apiService.getFacts()){
            if(i){
                self.headerBool = true;
            }
        }
        return apiService.getFacts();
    };
});