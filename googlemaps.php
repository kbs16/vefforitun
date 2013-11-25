<!DOCTYPE html>
<html lang="is">
  <head>
    <meta charset="UTF-8">
    <style>
      #map_canvas {
        width: 600px;
        height: 500px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="googlemaps.js"></script>
  </head>
  <body>
    <div id="map_canvas"></div>
    <? php 
    require('eqdata.php')
    ?>
  </body>
</html>
