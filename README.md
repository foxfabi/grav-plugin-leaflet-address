# Leaflet Address Plugin

**Leaflet Address** is a [Grav CMS](http://github.com/getgrav/grav) Plugin thats add the ability to easily embed a leaflet map to display an address with a marker.

At the moment the following map provider are available:

* OpenStreetMap Mapnik
* Esri WorldStreetMap
* CartoDB Voyager

## Installation

 * Download the zip version of this repository from [GitHub](https://github.com/foxfabi/grav-plugin-leaflet-address).
 * Unzip it under `/your/site/grav/user/plugins`.
 * Rename the folder to `leaflet-address`.

You should now have all the plugin files under

    /your/site/grav/user/plugins/leaflet-address

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/leaflet-address/leaflet-address.yaml` to `user/config/plugins/leaflet-address.yaml` and only edit that copy.

Here is a sample configuration:

```yaml
enabled: true
address:
  country: IT
  name: name
  address: 'Street address'
  zip: 'Postal code'
  city: Locality
  phone: 'Phone number'
  email: email@address.local
  state: 'State or Province'
  subaddress: 'Additional Address'
leaflet:
  zoom: 13
  icon: Yellow
  coordinates: '41.0819847,14.252262'
cdn: true
provider: OpenStreetMap.Mapnik
```

Options are pretty self explanatory.

### Using the Administration Panel plugin
If you use the admin plugin, a file named `leaflet-address.yaml` with your configuration will be saved in the `user/config/plugins/` folder once the configuration is saved.

When entering address, postcode, city and country, the coordinates search field will be completed accordingly. The search for coordinates uses the [photon.komoot.de](https://photon.komoot.de/) API and returns the first six matching entries. When selecting a result, the associated coordinates (longitude, latitude) are entered in the corresponding fields. You can also click on the map to change the marker position and get the `latitude,longitude` of the selected location.

![](assets/screenshots/plugin-config-ui.png)

## Usage
The plugin provides two Twig template that you can include in your theme or page where you want to add the leaflet map and address. Something like:
```
{% include "partials/leaflet-address.html.twig" with {'config': config.plugins['leaflet-address']} %}
{% include "partials/leaflet-address-map.html.twig" with {'config': config.plugins['leaflet-address']} %}
```

The plugin also provide a shortcode (**p**lugin **l**eaflet **a**ddress short**c**ode **e**mbed):

`[place]`

Options:
  * `[place type="addr"]` - display leaflet address (Using `leaflet-address.html.twig`)
  * `[place type="map"]` - display leaflet address map (Using `leaflet-address-map.html.twig`)

## Credits

* Thanks to [Tribly Media](https://trilby.media/) for creating and supporting [Grav CMS](https://getgrav.org/).
* [Marker icons](https://github.com/pointhi/leaflet-color-markers) are provided by [Thomas Pointhuber](https://github.com/pointhi).
* [Leaflet](https://leafletjs.com/), originally created by [Vladimir Agafonkin](https://agafonkin.com/).

## To Do

- [x] Translations (EN, DE)

