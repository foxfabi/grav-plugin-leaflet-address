# v1.0.5
## 04/24/2019

1. [](#new)
    * Added translation (IT)
1. [](#bugfix)
    * Seems onAdminTwigTemplatePaths does not work anymore
    * Removed dump on plugin config page (admin)

# v1.0.4
## 04/22/2019

1. [](#bugfix)
    * Grav 1.6 YAML has stricter parsing
    * Removed commented out code

# v1.0.3
## 04/22/2019

1. [](#new)
    * Limit zoom to map provider max zoom
1. [](#bugfix)
    * I didn't updated the version number in blueprints.yaml :/
    * Link to [README.md](README.md) now points to master branch
    * Removed footnotes to comply with changelog format
    * Meets the rules of markdownlint MD022, MD006, MD032, MD040

# v1.0.2
## 04/15/2019
1. [](#bugfix)
    * Wrong comparison link in the changelog

# v1.0.1
## 04/15/2019

1. [](#new)
   * Added translations (EN, DE)
   * Added many map providers
   * Fullfill OSM requirement _fixthemap_
1. [](#improved)
   * Missing Leaflet-providers, OpenStreetMap and map providers in credits
   * Default marker icon is red

# v0.1.3
## 04/14/2019

1. [](#new)
   * Separated the map from address twig template
   * Added a shortcode `[place]` with argument `type=map` or `type=addr` ([#2433: Suggestion from Andy Miller @rhukster](https://github.com/getgrav/grav/issues/2433#issuecomment-481479209))
1. [](#improved)
   * Backend also use configured icon
   * Added description to configure plugin using the Administration Panel
   * Replaced empty default configuration with a sample configuration
   * Added grav 1.5 dependency because I don't know the older one :)
   * Simplified onPluginsInitialized event
1. [](#bugfix)
   * Backend didn't know about config
   * Removed debugging lines

# v0.1.2
##  04/05/2019

1. [](#new)
    * First github release

# v0.1.0
##  04/03/2019

1. [](#new)
    * ChangeLog started...
