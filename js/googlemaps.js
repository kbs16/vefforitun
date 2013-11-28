 function initialize() {
        //var rvkLatlng = new google.maps.LatLng(63.916,-21.177);
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          zoom: 8,
          center: new google.maps.LatLng(63.916,-21.177),
          //mapTypeId: google.maps.MapTypeId.TERRAIN,
          mapTypeId: google.maps.MapTypeId.SATELLITE,
          mapTypeControl: false
        }
        var map = new google.maps.Map(map_canvas, map_options);

        //margir markerar http://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example
        $.getJSON("./cache/apis.is-earthquake-is.cache", function(data)
        {
            $.each(data.results, function(i, value)
            {
                var marker = new google.maps.Marker({
                //position:  new google.maps.LatLng(63.916,-21.177)
                position: new google.maps.LatLng(value.latitude,value.longitude),
                title: (value.humanReadableLocation + "\n" + "Stærð á Richter:" + value.size + "\n" + "Klukkan:" + value.timestamp)
                
                //map: map
                });
                marker.setMap(map);
            });
        });
        /*var marker = new google.maps.Marker({
            //osition: rvkLatlng,
            position:  new google.maps.LatLng(63.916,-21.177),
            title:"Halló Reykjavík!"
        });
        marker.setMap(map);*/
        

        }
        google.maps.event.addDomListener(window, 'load', initialize);