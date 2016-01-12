app.service('modalService', function(){
    var self = this;
    self.modalBool = true;
    self.returnModalBool = function(){
        return self.modalBool;
    };
});