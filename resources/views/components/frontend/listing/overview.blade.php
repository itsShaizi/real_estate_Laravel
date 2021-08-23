<div>
	<div class="border-b flex justify-between p-10">
		<div>{{ $listing->property_size }}</div>
		<div>{{ $listing->lot_size }}</div>
		<div>{{ $listing->beds }} - beds</div>
		<div>{{ $listing->baths }} - baths</div>
	</div>
	<div class="flex mt-10">
		<div class="flex flex-1 leading-loose px-5">
			<div class="flex-1"> 								
				@if($listing->title)
				<div>Title</div>
				<div class="font-bold">{{ $listing->title }}</div>
				@endif
				<div>Address</div>
				<div class="font-bold">{{ $listing->address }}</div>
				<div>City</div>
				<div class="font-bold">{{ $listing->city }}</div>
				<div>State</div>
				<div class="font-bold">{{ $listing->state->name }}</div>
				<div>Country</div>
				<div class="font-bold">{{ $listing->country->name }}</div>
			</div>
			<div class="flex-1"> 								
				<div>Property Type</div>
				<div class="font-bold">{{ $listing->property_type }}</div>
				<div>Property Size</div>
				<div class="font-bold">{{ $listing->property_size }}</div>
                <div>Lot Size</div>
				<div class="font-bold">{{ $listing->lot_size }}</div>
				<div>Data Source</div>
				<div class="font-bold">{{ $listing->provider_name }}</div>
				<div>MLS Number(s)</div>
				<div class="font-bold"><a href="{{ $listing->listing_source }}">Link</a></div>
			</div>
		</div>
							
		<div class="flex-1">
			<div id="map" class="h-full w-auto rounded-2xl"></div>
		</div>
	</div>

	<div class="leading-6 mt-5 text-sm">
		<h3 class="font-bold text-realty uppercase">Property Information</h3>
		<p>
			{{ $listing->description }}
		</p>
	</div>

</div>

<script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: <?=$listing->latitude?>, lng: <?=$listing->longitude?> };
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
