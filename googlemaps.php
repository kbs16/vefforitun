
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="./googlemaps.js"></script>
    <script type="text/javascript">
      setjaGogn(<?php echo json_encode($rest->get(EQ_URL, true)); ?>);
    </script>

    <div id="map_canvas"></div>
