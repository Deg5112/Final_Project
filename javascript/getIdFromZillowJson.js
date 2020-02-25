app.service('getIdFromZillowService', function($q){
   var self = this;
    self.zillowGetIdFromResponse = function(jsonResponse){
        var zpid = null;
        var result = jsonResponse['SearchResults:searchresults'];

        if(result.hasOwnProperty('response')) {

          result = result['response']['results']['result'];

          if (typeof result === 'object') {
            return result['zpid'];
          } else if (Array.isArray(result)) {
            return result[0]['zpid'];
          }
        }

        return null;
    };
});
