 function initialize() {
        var rvkLatlng = new google.maps.LatLng(64.1330,-21.9330);
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(64.1330,-21.9330),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options)

        //margir markerar http://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example
        var marker = new google.maps.Marker({
            position: rvkLatlng,
            title:"Halló Reykjavík!"
        });
        marker.setMap(map);
        

        }
        google.maps.event.addDomListener(window, 'load', initialize);