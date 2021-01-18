<section>
	<div id="map-canvas"/>

    <script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxjc9xnM0EwGaFKVkEpbnU2EFGCJzkph0&callback=initialize">
     </script>
     <script type="text/javascript">
 function initialize() {

      var stilovi = [
      {
      featureType: "all",
      stylers: [
        { saturation: -80 }
      ]
      },{
      featureType: "road.arterial",
      elementType: "geometry",
      stylers: [
        { hue: "#00ffee" },
        { saturation: 50 }
      ]
      },{
      featureType: "poi.business",
      elementType: "labels",
      stylers: [
        { visibility: "off" }
      ]
      }
    ];


    var stilizovanaMapa = new google.maps.StyledMapType(stilovi,
    {name: "Dentologie"});
    var podesavanjaMape = {
      center: new google.maps.LatLng(44.772742,20.475134),
      zoom: 16,
      minZoom: 10,
      zoomControl: true,
      zoomControlOptions: { position: google.maps.ControlPosition.TOP_RIGHT },
      panControl: true,
      panControlOptions: { position: google.maps.ControlPosition.TOP_RIGHT },
      streetViewControl: true,
      mapTypeControl: true,
      scaleControl: true,
      overviewMapControl: true,
      mapTypeId: 'ginmedMapa',
      mapTypeControlOptions: {
        mapTypeIds: [ 'ginmedMapa', google.maps.MapTypeId.TERRAIN, google.maps.MapTypeId.HYBRID ]
      }

    };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            podesavanjaMape);
         marker = new google.maps.Marker({
      position: new google.maps.LatLng(44.7725,20.475),
      map: map,
      title: 'GinekoMedika'

    });

    map.mapTypes.set('ginmedMapa', stilizovanaMapa);
    map.setMapTypeId('ginmedMapa');


      google.maps.event.addListener(map, 'click', function(event) {
    marker.setPosition(event.latLng);
     });

  google.maps.event.addListener(marker, 'click',function(event) {
    alert('Na ovoj lokaciji nas možete pronaći.');
  });
  }

      google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <style type="text/css">
    	#map-canvas { height: 30em; width: 100%; }
  </style>
</section>
