app.controller('statsController', function(apiService){
   var self = this;
    self.headerBool = false;

    self.returnNoResultsBool = function(){
      return apiService.noResultsBool;
    };

    self.stats = function(){
        console.log('FACTS', apiService.facts);
        for(var i in apiService.facts){
            if(i){
                self.headerBool = true;
            }
        }

        return apiService.facts;
    };
});