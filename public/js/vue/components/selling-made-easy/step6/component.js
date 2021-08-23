Vue.component('step6-component', {
	template: '#step6',
	props: ['days', 'address', 'coordonates', 'country', 
			'state', 'city', 'zip', 'countries', 'states', 
			'selectedCountry', 'selectedState'],
	data() {
		return { 
		}
	},
	methods: {
		goNext() {
			this.$emit('go-next');
		},
		daysOnMarket(val) {
			this.$emit('update-days-on-market', val);
		},
		countrySelected(countryItem) {
			if (this.country == 'USA') {
				return countryItem.Name == 'United States';
			}
			return countryItem.Name == this.country;
		},
		stateSelected(stateItem) {
			return stateItem.Name == this.state;
		},
		loopObject(key, value) {
			if (typeof value === 'object') {
      			for (const [key_o, value_o] of Object.entries(value)) {
      				//console.log(`${key} - ${key_o}: ${value_o}`);		
      				this.loopObject(key_o, value_o);
      			}
      		}
		},

		updateCityStateCountryZip(addr_comp) {
			// reset City, Zip
			this.updateCity('');
			this.updateZip('');
			for (var i = addr_comp.length - 1; i >= 0; i--) {
				switch(addr_comp[i].types[0]) {
					case 'locality': 
			            this.updateCity(addr_comp[i].long_name);
						break;
					case 'administrative_area_level_1': 
						this.updateState(addr_comp[i].long_name);
						break;
					case 'country': 
						this.updateCountry(addr_comp[i].long_name);
						break;
					case 'postal_code': 
						this.updateZip(addr_comp[i].long_name);
						break;
				}
			}
		},

		// COME BACK TO GET THE REAL DATA WITH GEOCODER: City, state, zip, country, address
		// Not through hacking the address received with js... Think...
		geocoderLocation( aPlace, geocoder ) {
		      var locationName = this.address;
		      geocoder.geocode({'location': aPlace}, function(results, status) {
		          if (status === 'OK') {
		            if (results[0]) {
		              locationName = results[0].address_components;
		              // console.log(locationName);
		              // $('#location').text(locationName);
		              // $('#location_address').val(locationName);
		              	for (const [key, value] of Object.entries(results[0])) {
		              		// console.log('Geocoder: ' + `${key}: ${value}`);
		              		this.app.$children[1].loopObject(key, value);
						}
		              // console.log('Default Object: '+results[0]);
		              //infowindow.open(map, marker);
		            } else {
		              alert('No results found');
		            }
		          } else {
		            alert('Geocoder failed due to: ' + status);
		          }
		        });
		      console.log(locationName);
		      return locationName;
		   },
		   geocodeAddress(geocoder, resultsMap) {
		        var address = this.address;
		        geocoder.geocode({'address': address}, function(results, status) {
		          if (status === 'OK') {
		            resultsMap.setCenter(results[0].geometry.location);
		            var marker = new google.maps.Marker({
		              map: resultsMap,
		              position: results[0].geometry.location
		            });
		          } else {
		            alert('Geocode was not successful for the following reason: ' + status);
		          }
		        });
		    },
		    getAddress() {
		    	return this.address.trim();
		    },
		   	updateNewAddress(addr_comp) {
		   		address = '';
		   		if (addr_comp) {
			            address = [
			              (addr_comp[0] && addr_comp[0].long_name || ''),
			              (addr_comp[1] && addr_comp[1].long_name || '')
			            ].join(' ');
			          }
		   		this.$emit('update-address', address);
		   	},
		   	updateNewCoordonates(pos) {
			   	this.$emit('update-coordonates', pos);
			},
			updateCity(val) {
		   		this.$emit('update-city', val);
		   	},
		   	updateZip(val) {
		   		this.$emit('update-zip', val);
		   	},
		   	updateState(val) {
		   		this.$emit('update-state', val);
		   	},
		   	updateCountry(val) {
		   		this.$emit('update-country', val);
		   	},
		   	updateSelectedCountry(val) {
		   		this.$emit('update-selected-country', val);
		   	},
		   	updateSelectedState(val) {
		   		this.$emit('update-selected-state', val);
		   	},
		   	handleLocationError(browserHasGeolocation, infoWindow, pos) {
		        infoWindow.setPosition(pos);
		        infoWindow.setContent(browserHasGeolocation ?
		                              'Error: The Geolocation service failed.' :
		                              'Error: Your browser doesn\'t support geolocation.');
		        infoWindow.open(map);
		    }
	},
	mounted() {
		var map, infoWindow, aPlace, pos, locationName;
		var app = this;
	    aPlace = this.coordonates ? this.coordonates : {lat: 43.628553, lng: -89.771427};
	    console.log(this.coordonates);
	    infoWindow = new google.maps.InfoWindow;

        var geocoder = new google.maps.Geocoder;
	    var map = new google.maps.Map(document.getElementById('map'), {
	        center: aPlace,
	        zoom: 3,
	        mapTypeId: 'roadmap',
	        mapTypeControlOptions: {}
	        //disableDefaultUI: true
	    });

	    var marker = {};
	    if( this.coordonates != null && Object.keys(this.coordonates).length )
	    {
	    	marker = new google.maps.Marker({
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				position: this.coordonates
			});
			map.setZoom(17);
	    }
	    // infoWindow = new google.maps.InfoWindow;

	    // ADD marker only when address is added...
	 //    marker = new google.maps.Marker({
		// 	map: map,
		// 	draggable: true,
		// 	animation: google.maps.Animation.DROP,
		// 	position: aPlace
		// });
	      // Find the default place
	    
	    // Try HTML5 geolocation.
        if (navigator.geolocation) {
        	console.log(navigator.geolocation);
	        navigator.geolocation.getCurrentPosition(function(position) {
	            var posme = {
	              lat: position.coords.latitude,
	              lng: position.coords.longitude
	            };

	            // infoWindow.setPosition(pos);
	            // infoWindow.setContent('Location found.');
	            // infoWindow.open(map);
	            map.setCenter(posme);
	            aPlace = posme;
	            marker = new google.maps.Marker({
					map: map,
					draggable: true,
					animation: google.maps.Animation.DROP,
					position: aPlace
				});
	           //  marker.setPosition(posme);
	          	// marker.setVisible(true);
	          }, function() {
	            // this.app.$children[1].handleLocationError(true, infoWindow, map.getCenter());
	            console.log('Oopps! Geolocation failed');
	          });
        } else {
          // Browser doesn't support Geolocation
          console.log('No support for Geolocation');
          // this.app.$children[1].handleLocationError(false, infoWindow, map.getCenter());
        }

	    // this.updateNewAddress(this.geocoderLocation( aPlace, geocoder ));
	    addressSavedUpdate = this.getAddress();
	    if (addressSavedUpdate.length < 5) {
		    var geoLoc = this.geocoderLocation( aPlace, geocoder );
		    console.log('GEOLOCATION: ' + geoLoc);
		    this.updateNewAddress(geoLoc);
		    this.updateCityStateCountryZip(geoLoc);
		}
	    this.updateNewCoordonates(aPlace);

	    var input = document.getElementById('address');
	    // var searchBox = new google.maps.places.SearchBox(input);
	    // // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	    // // Bias the SearchBox results towards current map's viewport.
	    // map.addListener('bounds_changed', function() {
	    //     searchBox.setBounds(map.getBounds());
	    // });

	    if( Object.keys(marker).length ) {
		    marker.addListener('dragend', function(){
	            pos = marker.getPosition();
	            map.setCenter(pos);
	            // aPlace = pos;
	            
			    geocoder.geocode({'location': pos}, function(results, status) {
			          if (status === 'OK') {
			          	if (results[0]) {
			          		for (const [key, value] of Object.entries(results[0])) {
			              		//console.log('Geocoder: ' + `${key}: ${value}`);
			              		this.app.$children[1].loopObject(key, value);
							}
							locationName = results[0].formatted_address;
							// Address
							// If an address already exists in the Input field then only adjust the Coordonates
							// Amanda requested this because some of the sellers have parcels where the address is not exactly right
							// but somewhere around there and google can pin point the exact location with Coordonates only... SO!!
							addressSaved = this.app.$children[1].getAddress();
							// console.log(addressSaved);
							// console.log(pos.lat() + '-' + pos.lng());
							if (addressSaved.length < 5) {
								this.app.$children[1].updateNewAddress(results[0].address_components);
								this.app.$children[1].updateCityStateCountryZip(results[0].address_components);
							}
							this.app.$children[1].updateNewCoordonates(pos);
							// this.$emit('update-coordonates', pos);
							console.log(locationName);
			            } else {
			            	alert('No results found');
			            }
			          } else {
			          	alert('Geocoder failed due to: ' + status);
			          }
		        });
	            // console.log("dragged A - " + locationName);
	        });
		}

	    var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var autocompleteAddress, autocompleteLocation;
	    autocomplete.addListener('place_changed', function() {
			// infowindow.close();
			if( ! Object.keys(marker).length ) {
				marker = new google.maps.Marker({
					map: map,
					draggable: true,
					animation: google.maps.Animation.DROP
				});
			}
			marker.setVisible(true);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
			// User entered the name of a Place that was not suggested and
			// pressed the Enter key, or the Place Details request failed.
			window.alert("No details available for input: '" + place.name + "'");
				return;
			}

			// If the place has a geometry, then present it on a map.
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.
			}
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);

			console.log(app);
	        app.updateNewAddress(place.address_components);
		    app.updateCityStateCountryZip(place.address_components);
	        app.updateNewCoordonates(place.geometry.location);
        });

	}
})