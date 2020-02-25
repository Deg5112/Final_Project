app.service('xmlToJsonService', function($q){
    var self = this;

    self.xmlToJson = function(xml) {
      if (xml == null) {
        $('#no-results').show();
        $('#zillow-loading-gif').hide();
      }

      try {
        var obj = {};
        if (xml.children.length > 0) {
          for (var i = 0; i < xml.children.length; i++) {
            var item = xml.children.item(i);
            var nodeName = item.nodeName;

            if (typeof (obj[nodeName]) == "undefined") {
              obj[nodeName] = self.xmlToJson(item);
            } else {
              if (typeof (obj[nodeName].push) == "undefined") {
                var old = obj[nodeName];

                obj[nodeName] = [];
                obj[nodeName].push(old);
              }
              obj[nodeName].push(self.xmlToJson(item));
            }
          }
        } else {
          obj = xml.textContent;
        }
        return obj;
      } catch (e) {
        console.log(e.message);
      }
  }
});
