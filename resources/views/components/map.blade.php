<div {{ $attributes }} id="map" class="h-full w-auto rounded-2xl"></div>

<script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: <?=$lat?>, lng: <?=$long?> };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
    icon: "/images/resources/marker-arrow-blue-small.png"
  });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=weekly&key=AIzaSyBqCLn0PkcVlSXmRMFBYWYvoB58UHjV7dw&callback=initMap"></script>
