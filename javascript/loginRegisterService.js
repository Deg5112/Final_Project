app.service('loginRegisterService', function($http){
   var self = this;
    self.token = null;
    self.login = function(username, password){
        var data = 'username='+username+'&password='+password;
        return $http({
            url: "http://localhost:8888/lfz/Final_Project/php/login.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            data: data
        }).then(function(response) {
            return response;
        });
    };

    //register method
    self.register = function(){

    };
});