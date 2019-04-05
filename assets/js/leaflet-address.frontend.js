function getMarkerIcon(path, icon) {
  var iconPath = path + '/assets/images/';
  switch (icon) {
    case "Blue":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-blue.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    case "Red":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-red.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    case "Green":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-green.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    case "Orange":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-orange.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    case "Yellow":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-yellow.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    case "Violet":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-violet.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    case "Grey":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-grey.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    case "Black":
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-black.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
    default:
      return new L.Icon({
        iconUrl: iconPath + 'marker-icon-2x-black.png',
        shadowUrl: iconPath + 'marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      break;
  }
}

function getLeafletProvider(provider) {
  switch (provider) {
    case "Esri.WorldStreetMap":
      return L.tileLayer('//server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
      });
      break;
    case "CartoDB.Voyager":
      return L.tileLayer('//{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 19
      });
      break;
    case "OpenStreetMap.Mapnik":
      return L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      });
      break;
    default:
      console.log("Sorry, unknow Leaflet Map Provider:" + provider + ".");
  }
}