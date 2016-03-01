app.controller('mainController', function($scope){
    var self = this;
    self.homeBool = true;
    self.active = function(event){
        var items = document.getElementsByClassName("bNav");
        var $items = angular.element(items);
        $items.css('color', 'white');
        console.log(items);

        var $target = angular.element(event.target);
        $target.css('color', '#0036DA');
    }

});