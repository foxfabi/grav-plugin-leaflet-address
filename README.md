# Leaflet Address Plugin

**Leaflet Address** is a [Grav CMS](http://github.com/getgrav/grav) Plugin thats
add the ability to easily embed a leaflet map to display an address with a marker.

## Installation

 * Download the zip version of this repository from [GitHub](https://github.com/foxfabi/grav-plugin-leaflet-address).
 * Unzip it under `/your/site/grav/user/plugins`.
 * Rename the folder to `leaflet-address`.


You should now have all the plugin files under

    /your/site/grav/user/plugins/leaflet-address
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/leaflet-address/leaflet-address.yaml` to `user/config/plugins/leaflet-address.yaml` and only edit that copy.

Here is the default configuration:

```yaml
enabled: true
address:
  country:
  name:
  address:
  zip:
  city:
  phone:
  email:
  state:
leaflet:
  zoom: 13
  icon: Yellow
  coordinates: 
cdn: true
provider: OpenStreetMap.Mapnik
```

Options are pretty self explanatory.

Note that if you use the admin plugin, a file with your configuration, and named `leaflet-address.yaml` will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage
The plugin provides two Twig template that you can include in your theme or page where you want to add the leaflet map and address. Something like:
```
{% include "partials/leaflet-address.html.twig" with {'config': config.plugins['leaflet-address']} %}
{% include "partials/leaflet-address-map.html.twig" with {'config': config.plugins['leaflet-address']} %}
```

The plugin also provide a shortcode:

`[place]`

Options:
  *   [place **type="addr"**]: display leaflet address (Using `leaflet-address.html.twig`)
  *   [place **type="map"**]:  display leaflet address map (Using `leaflet-address-map.html.twig`)

## Credits

* [Marker icons](https://github.com/pointhi/leaflet-color-markers) are provided by [Thomas Pointhuber](https://github.com/pointhi)

## To Do

- [ ] Translations

