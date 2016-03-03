app.controller('mainController', function($scope){
    var self = this;
    self.homeBool = true;
    $scope.aboutBool = false;
     $scope.apartmentSelectedBool = false;//true = hide   false= show
    self.active = function(event){
        var items = document.getElementsByClassName("bNav");
        var $items = angular.element(items);
        $items.css('color', 'white');
        //console.log(items);

        var $target = angular.element(event.target);
        $target.css('color', '#0036DA');
    }
    self.showModal = function(){
        if($scope.aboutBool){
            $scope.aboutBool = false;
        }else{
            $scope.aboutBool = true;
        }
    }

    self.switchApartmentSelectedBool = function(){
        if(!($scope.apartmentSelectedBool)) {
            $scope.apartmentSelectedBool = true;
        }
    }

});