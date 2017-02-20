app.service('getIdFromZillowService', function($q){
   var self = this;
    self.zillowGetIdFromResponse = function(jsonResponse){
        var zpid = null;
        var result = jsonResponse['SearchResults:searchresults'];

        if(result.hasOwnProperty('response')){

            result = result['response']['results']['result'];

            if(!(Array.isArray(result)) ){
                zpid = result['zpid']['#text'];
                //zillowGetPropInfo(zpid);
                return zpid;
            }

            if( Array.isArray(result) ) {
                for(var i = 0; i < result.length; i++){
                    zpid = result[i]['zpid']['#text'];
                    return zpid;
                }
            }
        }else{
            zpid = null;
        }
    };
});