app.service('getIdFromZillowService', function($q){
   var self = this;
    self.zillowGetIdFromResponse = function(jsonResponse){
        console.log(jsonResponse);
        var zpid = null;
        var result = jsonResponse['SearchResults:searchresults']['response']['results']['result'];


        if(!(Array.isArray(result)) ){
            console.log('not an array');
            zpid = result['zpid']['#text'];
            //zillowGetPropInfo(zpid);
            return zpid;
        }

        if( Array.isArray(result) ) {
            console.log('array!');
            for(var i = 0; i < result.length; i++){
                zpid = result[i]['zpid']['#text'];
                return zpid;
            }
        }
    };
});