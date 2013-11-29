 var gognin;

 function setjaGogn(gogn){
    gognin = gogn;
    console.log("Gögnin í setjaGogn eru :" + gogn);
 }

 function initialize() {
        //var rvkLatlng = new google.maps.LatLng(63.916,-21.177);
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          zoom: 6,
          center: new google.maps.LatLng(64.916,-19.500),
          //mapTypeId: google.maps.MapTypeId.TERRAIN,
          mapTypeId: google.maps.MapTypeId.SATELLITE,
          mapTypeControl: false
        }
        var map = new google.maps.Map(map_canvas, map_options);
        console.debug(gognin);
        //margir markerar http://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example
        if (gognin != false)
        {
            console.log("Gögn er til" + gognin);
            $.each(gognin.results, function(i, value)
            {
                var marker = new google.maps.Marker({
                //position:  new google.maps.LatLng(63.916,-21.177)
                position: new google.maps.LatLng(value.latitude,value.longitude),
                title: (value.humanReadableLocation + "\n" + "Stærð á Richter:" + value.size + "\n" + "Klukkan:" + value.timestamp)
                
                //map: map
                });
                marker.setMap(map);
            });
        }
        else
        {
            console.log("Gögn eru ekki til");
            $.getJSON("apis.is-earthquake-is.cache", function(data)
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
        }

        
        /*var marker = new google.maps.Marker({
            //osition: rvkLatlng,
            position:  new google.maps.LatLng(63.916,-21.177),
            title:"Halló Reykjavík!"
        });
        marker.setMap(map);*/
        

        }
        google.maps.event.addDomListener(window, 'load', initialize);