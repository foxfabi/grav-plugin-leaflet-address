<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Plugin\Form\Form;
use RocketTheme\Toolbox\Event\Event;
use Grav\Common\Language\LanguageCodes;

/**
 * Class LeafletAddressPlugin
 * @package Grav\Plugin
 */
class LeafletAddressPlugin extends Plugin
{
    const NAME = 'leaflet-address';
    protected $config;

    /**
     * @return bool
     */
    public static function checkRequirements(): bool
    {
        return version_compare(GRAV_VERSION, '1.5', '>');
    }

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        if (!static::checkRequirements()) {
            return [];
        }

        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {

        if ($this->config->get('plugins.' . self::NAME . '.enabled')) {
            //$language = $this->$grav['language']->

            // Enable the main event we are interested in
            if (!$this->isAdmin()) {
                $this->enable([
                    'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
                ]);
            } else {
                $this->enable([
                    'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
                ]);
            }
            $this->enable([
                'onPageInitialized'   => ['onPageInitialized', 0],
                'onAssetsInitialized' => ['onAssetsInitialized', 0],
                'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            ]);
        }
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onAdminTwigTemplatePaths($event)
    {
        $event['paths'] = [__DIR__ . '/admin/templates'];
    }

    /**
     * Initialize leaflet-address when in a page.
     */
    public function onPageInitialized()
    {
        $page = $this->grav['page'];
        if (!$page) {
            return;
        }
        $this->base = '/user/plugins/' . self::NAME;
        $this->config->set('plugins.' . self::NAME . '.path', $this->grav['uri']->rootUrl(false) . $this->base);
    }

    /**
     * Register the assets into collection and add it as needed.
     */
    public function onAssetsInitialized(Event $e)
    {
        $assets = $this->grav['assets'];
        $commonCollection = array();
        $frontendCollection = array();
        $backendCollection = array();

        if ($this->config->get('plugins.' . self::NAME . '.cdn')) {
            array_push($commonCollection, "//unpkg.com/leaflet@1.4.0/dist/leaflet.css");
            array_push($commonCollection, "//unpkg.com/leaflet@1.4.0/dist/leaflet.js");
        } else {
            array_push($commonCollection, "plugin://" . self::NAME . "/assets/css/leaflet.css");
            array_push($commonCollection, "plugin://" . self::NAME . "/assets/js/leaflet.js");
        }
        array_push($commonCollection, "plugin://" . self::NAME . "/assets/js/leaflet-address.frontend.js");
        array_push($frontendCollection, "plugin://" . self::NAME . "/assets/css/leaflet-address.frontend.css");
        array_push($backendCollection, "plugin://" . self::NAME . "/assets/css/leaflet-address.backend.css");
        array_push($backendCollection, "plugin://" . self::NAME . "/assets/js/leaflet-address.backend.js");

        $frontendCollection = array_merge($commonCollection, $frontendCollection);
        $backendCollection = array_merge($commonCollection, $backendCollection);

        $assets->registerCollection(self::NAME . '-frontend', $frontendCollection);
        $assets->registerCollection(self::NAME . '-backend', $backendCollection);

        if (!$this->isAdmin()) {
            $assets->add(self::NAME . '-frontend', 99);
        } else {
            $assets->add(self::NAME . '-backend', 99);
        }
    }

    /**
     * Register all shortcodes from folder
     *
     * @param Event $e
     */
    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/shortcodes');
    }

    /**
     * Returns the select list of leaflet providers
     *
     * @return array
     */
    public static function leafletProviders()
    {
        return array(
            'OpenStreetMap.Mapnik'      => 'OpenStreetMap Mapnik',
            'OpenStreetMap.DE'          => 'OpenStreetMap Deutscher Stil (DE)',
            'OpenStreetMap.HOT'         => 'OpenStreetMap Humanitarian (HOT)',
            'OpenTopoMap'               => 'Topographical Map (OpenTopoMap)',
            'Hydda.Full'                => 'Hydda Full',
            'Hydda.Base'                => 'Hydda Base',
            'Stamen.Toner'              => 'Stamen Toner',
            'Stamen.TonerBackground'    => 'Stamen TonerBackground',
            'Stamen.TonerLite'          => 'Stamen TonerLite',
            'Stamen.Watercolor'         => 'Stamen Watercolor',
            'Stamen.Terrain'            => 'Stamen Terrain',
            'Stamen.TerrainBackground'  => 'Stamen TerrainBackground',
            'Esri.WorldStreetMap'       => 'Esri WorldStreetMap',
            'Esri.DeLorme'              => 'Esri DeLorme',
            'Esri.WorldTopoMap'         => 'Esri WorldTopoMap',
            'Esri.NatGeoWorldMap'       => 'Esri NatGeoWorldMap',
            'MtbMap'                    => 'Mountainbike and Hiking Map (MtbMap)',
            'CartoDB.Positron'          => 'CartoDB Positron',
            'CartoDB.PositronNoLabels'  => 'CartoDB PositronNoLabels',
            'CartoDB.DarkMatter'        => 'CartoDB DarkMatter',
            'CartoDB.Voyager'           => 'CartoDB Voyager',
            'HikeBike.HikeBike'         => 'HikeBike HikeBike',
            'Wikimedia'                 => 'Wikimedia',
        );
    }

    /**
     * Returns the select list of marker icons
     *
     * @return array
     */
    public static function markerIcons()
    {
        return array(
            'Blue'   => 'Blue',
            'Red'    => 'Red',
            'Green'  => 'Green',
            'Orange' => 'Orange',
            'Yellow' => 'Yellow',
            'Violet' => 'Violet',
            'Grey'   => 'Grey',
            'Black'  => 'Black',
        );
    }

    /**
     * Returns the select list of country codes
     *
     * @return array
     */
    public static function countryCodes()
    {
        return array(
            'Afghanistan' => 'Afghanistan',
            'Åland Islands' => 'Åland Islands',
            'Albania' => 'Albania',
            'Algeria' => 'Algeria',
            'American Samoa' => 'American Samoa',
            'Andorra' => 'Andorra',
            'Angola' => 'Angola',
            'Anguilla' => 'Anguilla',
            'Antarctica' => 'Antarctica',
            'Antigua & Barbuda' => 'Antigua & Barbuda',
            'Argentina' => 'Argentina',
            'Armenia' => 'Armenia',
            'Aruba' => 'Aruba',
            'Ascension Island' => 'Ascension Island',
            'Australia' => 'Australia',
            'Austria' => 'Austria',
            'Azerbaijan' => 'Azerbaijan',
            'Bahamas' => 'Bahamas',
            'Bahrain' => 'Bahrain',
            'Bangladesh' => 'Bangladesh',
            'Barbados' => 'Barbados',
            'Belarus' => 'Belarus',
            'Belgium' => 'Belgium',
            'Belize' => 'Belize',
            'Benin' => 'Benin',
            'Bermuda' => 'Bermuda',
            'Bhutan' => 'Bhutan',
            'Bolivia' => 'Bolivia',
            'Bosnia & Herzegovina' => 'Bosnia & Herzegovina',
            'Botswana' => 'Botswana',
            'Brazil' => 'Brazil',
            'British Indian Ocean Territory' => 'British Indian Ocean Territory',
            'British Virgin Islands' => 'British Virgin Islands',
            'Brunei' => 'Brunei',
            'Bulgaria' => 'Bulgaria',
            'Burkina Faso' => 'Burkina Faso',
            'Burundi' => 'Burundi',
            'Cambodia' => 'Cambodia',
            'Cameroon' => 'Cameroon',
            'Canada' => 'Canada',
            'Canary Islands' => 'Canary Islands',
            'Cape Verde' => 'Cape Verde',
            'Caribbean Netherlands' => 'Caribbean Netherlands',
            'Cayman Islands' => 'Cayman Islands',
            'Central African Republic' => 'Central African Republic',
            'Ceuta & Melilla' => 'Ceuta & Melilla',
            'Chad' => 'Chad',
            'Chile' => 'Chile',
            'China' => 'China',
            'Christmas Island' => 'Christmas Island',
            'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands',
            'Colombia' => 'Colombia',
            'Comoros' => 'Comoros',
            'Congo - Brazzaville' => 'Congo - Brazzaville',
            'Congo - Kinshasa' => 'Congo - Kinshasa',
            'Cook Islands' => 'Cook Islands',
            'Costa Rica' => 'Costa Rica',
            'Côte d’Ivoire' => 'Côte d’Ivoire',
            'Croatia' => 'Croatia',
            'Cuba' => 'Cuba',
            'Curaçao' => 'Curaçao',
            'Cyprus' => 'Cyprus',
            'Czechia' => 'Czechia',
            'Denmark' => 'Denmark',
            'Diego Garcia' => 'Diego Garcia',
            'Djibouti' => 'Djibouti',
            'Dominica' => 'Dominica',
            'Dominican Republic' => 'Dominican Republic',
            'Ecuador' => 'Ecuador',
            'Egypt' => 'Egypt',
            'El Salvador' => 'El Salvador',
            'Equatorial Guinea' => 'Equatorial Guinea',
            'Eritrea' => 'Eritrea',
            'Estonia' => 'Estonia',
            'Ethiopia' => 'Ethiopia',
            'Eurozone' => 'Eurozone',
            'Falkland Islands' => 'Falkland Islands',
            'Faroe Islands' => 'Faroe Islands',
            'Fiji' => 'Fiji',
            'Finland' => 'Finland',
            'France' => 'France',
            'French Guiana' => 'French Guiana',
            'French Polynesia' => 'French Polynesia',
            'French Southern Territories' => 'French Southern Territories',
            'Gabon' => 'Gabon',
            'Gambia' => 'Gambia',
            'Georgia' => 'Georgia',
            'Germany' => 'Germany',
            'Ghana' => 'Ghana',
            'Gibraltar' => 'Gibraltar',
            'Greece' => 'Greece',
            'Greenland' => 'Greenland',
            'Grenada' => 'Grenada',
            'Guadeloupe' => 'Guadeloupe',
            'Guam' => 'Guam',
            'Guatemala' => 'Guatemala',
            'Guernsey' => 'Guernsey',
            'Guinea' => 'Guinea',
            'Guinea-Bissau' => 'Guinea-Bissau',
            'Guyana' => 'Guyana',
            'Haiti' => 'Haiti',
            'Honduras' => 'Honduras',
            'Hong Kong SAR China' => 'Hong Kong SAR China',
            'Hungary' => 'Hungary',
            'Iceland' => 'Iceland',
            'India' => 'India',
            'Indonesia' => 'Indonesia',
            'Iran' => 'Iran',
            'Iraq' => 'Iraq',
            'Ireland' => 'Ireland',
            'Isle of Man' => 'Isle of Man',
            'Israel' => 'Israel',
            'Italy' => 'Italy',
            'Jamaica' => 'Jamaica',
            'Japan' => 'Japan',
            'Jersey' => 'Jersey',
            'Jordan' => 'Jordan',
            'Kazakhstan' => 'Kazakhstan',
            'Kenya' => 'Kenya',
            'Kiribati' => 'Kiribati',
            'Kosovo' => 'Kosovo',
            'Kuwait' => 'Kuwait',
            'Kyrgyzstan' => 'Kyrgyzstan',
            'Laos' => 'Laos',
            'Latvia' => 'Latvia',
            'Lebanon' => 'Lebanon',
            'Lesotho' => 'Lesotho',
            'Liberia' => 'Liberia',
            'Libya' => 'Libya',
            'Liechtenstein' => 'Liechtenstein',
            'Lithuania' => 'Lithuania',
            'Luxembourg' => 'Luxembourg',
            'Macau SAR China' => 'Macau SAR China',
            'Macedonia' => 'Macedonia',
            'Madagascar' => 'Madagascar',
            'Malawi' => 'Malawi',
            'Malaysia' => 'Malaysia',
            'Maldives' => 'Maldives',
            'Mali' => 'Mali',
            'Malta' => 'Malta',
            'Marshall Islands' => 'Marshall Islands',
            'Martinique' => 'Martinique',
            'Mauritania' => 'Mauritania',
            'Mauritius' => 'Mauritius',
            'Mayotte' => 'Mayotte',
            'Mexico' => 'Mexico',
            'Micronesia' => 'Micronesia',
            'Moldova' => 'Moldova',
            'Monaco' => 'Monaco',
            'Mongolia' => 'Mongolia',
            'Montenegro' => 'Montenegro',
            'Montserrat' => 'Montserrat',
            'Morocco' => 'Morocco',
            'Mozambique' => 'Mozambique',
            'Myanmar (Burma)' => 'Myanmar (Burma)',
            'Namibia' => 'Namibia',
            'Nauru' => 'Nauru',
            'Nepal' => 'Nepal',
            'Netherlands' => 'Netherlands',
            'New Caledonia' => 'New Caledonia',
            'New Zealand' => 'New Zealand',
            'Nicaragua' => 'Nicaragua',
            'Niger' => 'Niger',
            'Nigeria' => 'Nigeria',
            'Niue' => 'Niue',
            'Norfolk Island' => 'Norfolk Island',
            'North Korea' => 'North Korea',
            'Northern Mariana Islands' => 'Northern Mariana Islands',
            'Norway' => 'Norway',
            'Oman' => 'Oman',
            'Pakistan' => 'Pakistan',
            'Palau' => 'Palau',
            'Palestinian Territories' => 'Palestinian Territories',
            'Panama' => 'Panama',
            'Papua New Guinea' => 'Papua New Guinea',
            'Paraguay' => 'Paraguay',
            'Peru' => 'Peru',
            'Philippines' => 'Philippines',
            'Pitcairn Islands' => 'Pitcairn Islands',
            'Poland' => 'Poland',
            'Portugal' => 'Portugal',
            'Puerto Rico' => 'Puerto Rico',
            'Qatar' => 'Qatar',
            'Réunion' => 'Réunion',
            'Romania' => 'Romania',
            'Russia' => 'Russia',
            'Rwanda' => 'Rwanda',
            'Samoa' => 'Samoa',
            'San Marino' => 'San Marino',
            'São Tomé & Príncipe' => 'São Tomé & Príncipe',
            'Saudi Arabia' => 'Saudi Arabia',
            'Senegal' => 'Senegal',
            'Serbia' => 'Serbia',
            'Seychelles' => 'Seychelles',
            'Sierra Leone' => 'Sierra Leone',
            'Singapore' => 'Singapore',
            'Sint Maarten' => 'Sint Maarten',
            'Slovakia' => 'Slovakia',
            'Slovenia' => 'Slovenia',
            'Solomon Islands' => 'Solomon Islands',
            'Somalia' => 'Somalia',
            'South Africa' => 'South Africa',
            'South Georgia & South Sandwich Islands' => 'South Georgia & South Sandwich Islands',
            'South Korea' => 'South Korea',
            'South Sudan' => 'South Sudan',
            'Spain' => 'Spain',
            'Sri Lanka' => 'Sri Lanka',
            'St. Barthélemy' => 'St. Barthélemy',
            'St. Helena' => 'St. Helena',
            'St. Kitts & Nevis' => 'St. Kitts & Nevis',
            'St. Lucia' => 'St. Lucia',
            'St. Martin' => 'St. Martin',
            'St. Pierre & Miquelon' => 'St. Pierre & Miquelon',
            'St. Vincent & Grenadines' => 'St. Vincent & Grenadines',
            'Sudan' => 'Sudan',
            'Suriname' => 'Suriname',
            'Svalbard & Jan Mayen' => 'Svalbard & Jan Mayen',
            'Swaziland' => 'Swaziland',
            'Sweden' => 'Sweden',
            'Switzerland' => 'Switzerland',
            'Syria' => 'Syria',
            'Taiwan' => 'Taiwan',
            'Tajikistan' => 'Tajikistan',
            'Tanzania' => 'Tanzania',
            'Thailand' => 'Thailand',
            'Timor-Leste' => 'Timor-Leste',
            'Togo' => 'Togo',
            'Tokelau' => 'Tokelau',
            'Tonga' => 'Tonga',
            'Trinidad & Tobago' => 'Trinidad & Tobago',
            'Tristan da Cunha' => 'Tristan da Cunha',
            'Tunisia' => 'Tunisia',
            'Turkey' => 'Turkey',
            'Turkmenistan' => 'Turkmenistan',
            'Turks & Caicos Islands' => 'Turks & Caicos Islands',
            'Tuvalu' => 'Tuvalu',
            'U.S. Outlying Islands' => 'U.S. Outlying Islands',
            'U.S. Virgin Islands' => 'U.S. Virgin Islands',
            'Uganda' => 'Uganda',
            'Ukraine' => 'Ukraine',
            'United Arab Emirates' => 'United Arab Emirates',
            'United Kingdom' => 'United Kingdom',
            'United Nations' => 'United Nations',
            'United States' => 'United States',
            'Uruguay' => 'Uruguay',
            'Uzbekistan' => 'Uzbekistan',
            'Vanuatu' => 'Vanuatu',
            'Vatican City' => 'Vatican City',
            'Venezuela' => 'Venezuela',
            'Vietnam' => 'Vietnam',
            'Wallis & Futuna' => 'Wallis & Futuna',
            'Western Sahara' => 'Western Sahara',
            'Yemen' => 'Yemen',
            'Zambia' => 'Zambia',
            'Zimbabwe' => 'Zimbabwe',
        );
    }
}
