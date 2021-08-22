<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/esri/themes/light/main.css">

    <script>
  require([
      "esri/Map",
      "esri/views/MapView"
    ], function(Map, MapView) {

    var map = new Map({
      basemap: "topo-vector"
    });

    var view = new MapView({
      container: "viewDiv",
      map: map,
      center: [-118.80500, 34.02700], // longitude, latitude
      zoom: 13
    });
  });
  </script>
  <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>ArcGIS JavaScript Tutorials: Create a JavaScript starter app</title>
    <style>
      html, body, #viewDiv {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="viewDiv"></div>
  </body>

</html>