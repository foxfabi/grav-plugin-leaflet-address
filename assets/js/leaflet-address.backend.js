/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
getPhotonLocations = function(value) {
	$('#coordinateselector-datalist').html('')
	return new Promise(function(resolve, reject) {
		var items = []

		var url =
			'//photon.komoot.de/api/?q=' + encodeURI(value) + '&lang=en&limit=6' // &osm_tag=place

		$.getJSON(url)
			.done(function(data) {
				$.each(data, function(key, val) {
					if ($.isArray(val)) {
						$.each(val, function(subKey, subVal) {
							console.log(val, subVal)

							var name =
								subVal.properties.name !== undefined
									? subVal.properties.name
									: ''
							var postcode =
								subVal.properties.postcode !== undefined
									? subVal.properties.postcode
									: ''
							var state =
								subVal.properties.state !== undefined
									? subVal.properties.state
									: ''
							var country =
								subVal.properties.country !== undefined
									? subVal.properties.country
									: ''
							var place = $.grep(
								[name, state, country, postcode],
								Boolean
							).join(', ') // foo, bar
							var option = $('<option/>', {
								value:
									subVal.geometry.coordinates[1] +
									',' +
									subVal.geometry.coordinates[0],
								html: place
							})

							option.click(function(event) {
								var coord = event.target.value
								$('#coordinateselector-value').val(coord)
								$('#coordinateselector-value').trigger('change')
								$('#coordinateselector-datalist').hide()
							})
							$('#coordinateselector-datalist').append(option)
						})
					}
				})
				resolve('getPhotonLocations worked!')
			})
			.fail(function(jqxhr, textStatus, error) {
				var err = textStatus + ', ' + error
				console.log('Request Failed: ' + err)
				reject(Error('getPhotonLocations broke'))
			})
	})
}

valueToMarker = function(map, iconpath, icon) {
	var marker = undefined
	try {
		var res = $('#coordinateselector-value')
			.val()
			.split(',')
		if (res[0] && res[1]) {
			$('#coordinateselector-lat').html(res[0])
			$('#coordinateselector-lng').html(res[1])
			var latlng = L.latLng(res[0], res[1])
			var markerIcon = getMarkerIcon(iconpath, icon)
			marker = L.marker(latlng, { draggable: false, icon: markerIcon })
			marker.addTo(map)
			centerMapOnMarker(map, marker)
			return marker
		}
	} catch (error) {
		//console.log(error);
	}
}

fetchCoordinate = function(event) {
	try {
		$('#coordinateselector-value').val(
			event.latlng.lat + ',' + event.latlng.lng
		)
		$('#coordinateselector-value').trigger('change')
	} catch (error) {
		//console.log(error);
	}
}

bindPrepareSearch = function() {
	var fields = ['address', 'zip', 'city', 'country']
	$.each(fields, function(index, value) {
		$('#coordinateselector-' + value).change(function() {
			prepareSearch()
		})
	})
}

prepareSearch = function() {
	var search = []
	try {
		if ($('#coordinateselector-address').val() !== undefined) {
			search.push($('#coordinateselector-address').val())
		}
		if ($('#coordinateselector-zip').val() !== undefined) {
			search.push($('#coordinateselector-zip').val())
		}
		if ($('#coordinateselector-city').val() !== undefined) {
			search.push($('#coordinateselector-city').val())
		}
		if ($('#coordinateselector-country').val() !== undefined) {
			search.push($('#coordinateselector-country').val())
		}
		$('#coordinateselector-search').html(search.join(' '))
	} catch (error) {
		console.log(error)
	}
}
bindSearchButton = function() {
	$('#coordinateselector-do-search').on('click touch', function(event) {
		if ($('#coordinateselector-search').text() !== undefined) {
			$('#coordinateselector-searching').show()
			getPhotonLocations($('#coordinateselector-search').text()).then(function(
				result
			) {
				$('#coordinateselector-searching').hide()
				$('#coordinateselector-datalist').show()
			})
		}
		return false
	})
}
