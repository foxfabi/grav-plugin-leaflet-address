/* eslint-disable no-undef */
/* eslint-disable no-unused-vars */
function getMarkerIcon(path, icon) {
	var iconPath = path + '/assets/images/'
	switch (icon) {
		case 'Blue':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-blue.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		case 'Red':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-red.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		case 'Green':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-green.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		case 'Orange':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-orange.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		case 'Yellow':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-yellow.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		case 'Violet':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-violet.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		case 'Grey':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-grey.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		case 'Black':
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-black.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
		default:
			return new L.Icon({
				iconUrl: iconPath + 'marker-icon-2x-black.png',
				shadowUrl: iconPath + 'marker-shadow.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
			break
	}
}

function getLeafletProvider(provider) {
	switch (provider) {
		case 'OpenStreetMap.Mapnik':
			return L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution:
					'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			})
			break
		case 'OpenStreetMap.DE':
			return L.tileLayer(
				'https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png',
				{
					maxZoom: 18,
					attribution:
						'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				}
			)
			break
		case 'OpenStreetMap.HOT':
			return L.tileLayer(
				'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
				{
					maxZoom: 19,
					attribution:
						'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
				}
			)
			break
		case 'OpenTopoMap':
			return L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
				maxZoom: 17,
				attribution:
					'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
			})
			break
		case 'Hydda.Full':
			return L.tileLayer(
				'https://{s}.tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png',
				{
					maxZoom: 18,
					attribution:
						'Tiles courtesy of <a href="http://openstreetmap.se/" target="_blank">OpenStreetMap Sweden</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				}
			)
			break
		case 'Hydda.Base':
			return L.tileLayer(
				'https://{s}.tile.openstreetmap.se/hydda/base/{z}/{x}/{y}.png',
				{
					maxZoom: 18,
					attribution:
						'Tiles courtesy of <a href="http://openstreetmap.se/" target="_blank">OpenStreetMap Sweden</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				}
			)
			break
		case 'Stamen.Toner':
			return L.tileLayer(
				'https://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}{r}.{ext}',
				{
					attribution:
						'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
					subdomains: 'abcd',
					minZoom: 0,
					maxZoom: 20,
					ext: 'png'
				}
			)
			break
		case 'Stamen.TonerBackground':
			return L.tileLayer(
				'https://stamen-tiles-{s}.a.ssl.fastly.net/toner-background/{z}/{x}/{y}{r}.{ext}',
				{
					attribution:
						'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
					subdomains: 'abcd',
					minZoom: 0,
					maxZoom: 20,
					ext: 'png'
				}
			)
			break
		case 'Stamen.TonerLite':
			return L.tileLayer(
				'https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.{ext}',
				{
					attribution:
						'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
					subdomains: 'abcd',
					minZoom: 0,
					maxZoom: 20,
					ext: 'png'
				}
			)
			break
		case 'Stamen.Watercolor':
			return L.tileLayer(
				'https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}',
				{
					attribution:
						'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
					subdomains: 'abcd',
					minZoom: 1,
					maxZoom: 16,
					ext: 'jpg'
				}
			)
			break
		case 'Stamen.Terrain':
			return L.tileLayer(
				'https://stamen-tiles-{s}.a.ssl.fastly.net/terrain/{z}/{x}/{y}{r}.{ext}',
				{
					attribution:
						'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
					subdomains: 'abcd',
					minZoom: 0,
					maxZoom: 18,
					ext: 'png'
				}
			)
			break
		case 'Stamen.TerrainBackground':
			return L.tileLayer(
				'https://stamen-tiles-{s}.a.ssl.fastly.net/terrain-background/{z}/{x}/{y}{r}.{ext}',
				{
					attribution:
						'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
					subdomains: 'abcd',
					minZoom: 0,
					maxZoom: 18,
					ext: 'png'
				}
			)
			break
		case 'Esri.WorldStreetMap':
			return L.tileLayer(
				'//server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
				{
					attribution:
						'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
				}
			)
			break
		case 'Esri.DeLorme':
			return L.tileLayer(
				'https://server.arcgisonline.com/ArcGIS/rest/services/Specialty/DeLorme_World_Base_Map/MapServer/tile/{z}/{y}/{x}',
				{
					attribution:
						'Tiles &copy; Esri &mdash; Copyright: &copy;2012 DeLorme',
					minZoom: 1,
					maxZoom: 11
				}
			)
			break
		case 'Esri.WorldTopoMap':
			return L.tileLayer(
				'https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}',
				{
					attribution:
						'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community'
				}
			)
			break
		case 'Esri.NatGeoWorldMap':
			return L.tileLayer(
				'https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}',
				{
					attribution:
						'Tiles &copy; Esri &mdash; National Geographic, Esri, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC',
					maxZoom: 16
				}
			)
			break
		case 'MtbMap':
			return L.tileLayer('http://tile.mtbmap.cz/mtbmap_tiles/{z}/{x}/{y}.png', {
				attribution:
					'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &amp; USGS'
			})
			break
		case 'CartoDB.Positron':
			return L.tileLayer(
				'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
				{
					attribution:
						'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
					subdomains: 'abcd',
					maxZoom: 19
				}
			)
			break
		case 'CartoDB.PositronNoLabels':
			return L.tileLayer(
				'https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png',
				{
					attribution:
						'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
					subdomains: 'abcd',
					maxZoom: 19
				}
			)
			break
		case 'CartoDB.DarkMatter':
			return L.tileLayer(
				'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',
				{
					attribution:
						'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
					subdomains: 'abcd',
					maxZoom: 19
				}
			)
			break
		case 'CartoDB.Voyager':
			return L.tileLayer(
				'//{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
				{
					attribution:
						'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
					subdomains: 'abcd',
					maxZoom: 19
				}
			)
			break
		case 'HikeBike.HikeBike':
			return L.tileLayer('https://tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution:
					'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			})
			break
		case 'Wikimedia':
			return L.tileLayer(
				'https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png',
				{
					attribution:
						'<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>',
					minZoom: 1,
					maxZoom: 19
				}
			)
			break
		default:
			console.log('Sorry, unknow Leaflet Map Provider:' + provider + '.')
	}
}
