app.controller('mainController', function($scope){
    var self = this;
    self.homeBool = true;
    self.active = function(event){
        $('.bNav').css('color', 'white');
        $(event.target).css('color', '#0036DA');
    }

});