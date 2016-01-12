app.service('loginRegisterService', function($http, $log){
   var self = this;
    self.token = null;
    self.username = null;
    self.loggedInBool = false;

    self.logout = function(){
        $log.info('LOG OUT SERVICE HIT!', self.token);

       var token = self.token;
            $http({
                data: "token="+token,
                url: ' http://localhost:8888/lfz/Final_Project/php/logOut.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST'
            }).then(function(response){
                if(response.data.success){
                    self.loggedInBool = false;
                }else{
                }
            }, function(response){
                $log.info('server ERRROR');
            });
    };

    self.compareTokens = function (token){
        return $http({
            data: "token="+token,
            url: 'http://localhost:8888/lfz/Final_Project/php/compareTokens.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST'
        }).success(function (response) {
        }).error(function (response) {
            $log.error('Error loading data', response);
        });
    };

    self.checkIfLoggedIn = function(){
        //update current token on page load
        var token = localStorage.getItem("AS");

        if(token){
            self.compareTokens(token).then(function(response){
                $log.info(response);
                if(response.data.success){
                    self.token = token;
                    //this means the tokens match and we are still logged in
                    self.username = response.data.username;
                    self.loggedInBool = true;
                    //we need to grab the name of the id and stick it up there as well
                }else{
                    console.log('false', response);
                    //either tokens did not match, or the token was deleted on the server but not the client
                }
            });
        }else{
            //$log.info('no token!');
        }
    };
    self.checkIfLoggedIn();


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