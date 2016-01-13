app.service('getIdFromZillowService', function($q){
   var self = this;
    self.zillowGetIdFromResponse = function(jsonResponse){
        console.log(jsonResponse);
        var zpid = null;
        var result = jsonResponse['SearchResults:searchresults'];

        if(result.hasOwnProperty('response')){

            console.log('TRUE!!!');
            result = result['response']['results']['result'];

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
        }else{
            zpid = null;
        }
    };
});