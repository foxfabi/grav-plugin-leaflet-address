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
    protected $config;

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
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {

        $config = $this->grav['config']->get('plugins.leaflet-address');
        //$language = $this->$grav['language']->
        if (!$this->isAdmin()) {
          // Enable the main event we are interested in
          $this->enable([
              'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
              'onPageInitialized'   => ['onPageInitialized', 0],
              'onAssetsInitialized' => ['onAssetsInitialized', 0],
              'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
          ]);
        } else {
          $this->enable([
              'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
              'onAssetsInitialized' => ['onAssetsInitialized', 0],
              'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
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
     * Initialize leaflet-address when detected in a page.
     */
    public function onPageInitialized()
    {
        $page = $this->grav['page'];
        if (!$page) {
            return;
        }
        $twig   = $this->grav['twig'];
        $this->base = '/user/plugins/leaflet-address';
        $this->config->set('plugins.leaflet-address.path', $this->grav['uri']->rootUrl(false) . $this->base);
        $config = $this->config->toArray();
    }

    public function onAssetsInitialized(Event $e)
    {
        $assets = $this->grav['assets'];
        $commonCollection = array();
        $frontendCollection = array();
        $backendCollection = array();

        if ($this->config->get('plugins.leaflet-address.cdn')) {
            array_push($commonCollection,"//unpkg.com/leaflet@1.4.0/dist/leaflet.css");
            array_push($commonCollection,"//unpkg.com/leaflet@1.4.0/dist/leaflet.js");
        } else {
            array_push($commonCollection,"plugin://leaflet-address/assets/css/leaflet.css");
            array_push($commonCollection,"plugin://leaflet-address/assets/js/leaflet.js");
        }

        array_push($frontendCollection,"plugin://leaflet-address/assets/js/leaflet-address.frontend.js");
        array_push($frontendCollection,"plugin://leaflet-address/assets/css/leaflet-address.frontend.css");
        array_push($backendCollection,"plugin://leaflet-address/assets/css/leaflet-address.backend.css");
        array_push($backendCollection,"plugin://leaflet-address/assets/js/leaflet-address.frontend.js");
        array_push($backendCollection,"plugin://leaflet-address/assets/js/leaflet-address.backend.js");

        $frontendCollection = array_merge($commonCollection, $frontendCollection);
        $backendCollection = array_merge($commonCollection, $backendCollection);

        $assets->registerCollection('leaflet-address-frontend', $frontendCollection);
        $assets->registerCollection('leaflet-address-backend', $backendCollection);

        if (!$this->isAdmin()) {
          $assets->add('leaflet-address-frontend', 100);
        } else {
          $assets->add('leaflet-address-backend', 100);
        }
    }

    public function onTwigSiteVariables()
    {

        // Initialize Admin Language if needed
        $language = $this->grav['language'];
        if ($language->enabled() && empty($this->grav['session']->admin_lang)) {
            $this->grav['session']->admin_lang = $language->getLanguage();
        }

        $translations = array();
        $strings = [
            'SEARCH_LABEL',
            'COORDINATES_LABEL',
            'LATITUDE_LABEL',
            'LONGITUDE_LABEL'
        ];
        $translations['LANG'] = $this->grav['language']->getLanguage();
        foreach ($strings as $string) {
          $translations[$string] = $this->grav['language']->translate('PLUGIN_LEAFLET_ADDRESS.TEMPLATES.' . $string);
        }

        $this->grav['twig']->twig_vars['translations'] = $translations;
    }

    /**
     * Returns the select list of leaflet providers
     *
     * @return array
     */
    public static function leafletProviders()
    {
        return array (
          'OpenStreetMap.Mapnik' => 'OpenStreetMap Mapnik',
          'Esri.WorldStreetMap'  => 'Esri WorldStreetMap',
          'CartoDB.Voyager'      => 'CartoDB Voyager',
        );        
    }

    /**
     * Returns the select list of marker icons
     *
     * @return array
     */
    public static function markerIcons()
    {
        return array (
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
        return array (
          'AF' => 'Afghanistan',
          'AX' => 'Åland Islands',
          'AL' => 'Albania',
          'DZ' => 'Algeria',
          'AS' => 'American Samoa',
          'AD' => 'Andorra',
          'AO' => 'Angola',
          'AI' => 'Anguilla',
          'AQ' => 'Antarctica',
          'AG' => 'Antigua & Barbuda',
          'AR' => 'Argentina',
          'AM' => 'Armenia',
          'AW' => 'Aruba',
          'AC' => 'Ascension Island',
          'AU' => 'Australia',
          'AT' => 'Austria',
          'AZ' => 'Azerbaijan',
          'BS' => 'Bahamas',
          'BH' => 'Bahrain',
          'BD' => 'Bangladesh',
          'BB' => 'Barbados',
          'BY' => 'Belarus',
          'BE' => 'Belgium',
          'BZ' => 'Belize',
          'BJ' => 'Benin',
          'BM' => 'Bermuda',
          'BT' => 'Bhutan',
          'BO' => 'Bolivia',
          'BA' => 'Bosnia & Herzegovina',
          'BW' => 'Botswana',
          'BR' => 'Brazil',
          'IO' => 'British Indian Ocean Territory',
          'VG' => 'British Virgin Islands',
          'BN' => 'Brunei',
          'BG' => 'Bulgaria',
          'BF' => 'Burkina Faso',
          'BI' => 'Burundi',
          'KH' => 'Cambodia',
          'CM' => 'Cameroon',
          'CA' => 'Canada',
          'IC' => 'Canary Islands',
          'CV' => 'Cape Verde',
          'BQ' => 'Caribbean Netherlands',
          'KY' => 'Cayman Islands',
          'CF' => 'Central African Republic',
          'EA' => 'Ceuta & Melilla',
          'TD' => 'Chad',
          'CL' => 'Chile',
          'CN' => 'China',
          'CX' => 'Christmas Island',
          'CC' => 'Cocos (Keeling) Islands',
          'CO' => 'Colombia',
          'KM' => 'Comoros',
          'CG' => 'Congo - Brazzaville',
          'CD' => 'Congo - Kinshasa',
          'CK' => 'Cook Islands',
          'CR' => 'Costa Rica',
          'CI' => 'Côte d’Ivoire',
          'HR' => 'Croatia',
          'CU' => 'Cuba',
          'CW' => 'Curaçao',
          'CY' => 'Cyprus',
          'CZ' => 'Czechia',
          'DK' => 'Denmark',
          'DG' => 'Diego Garcia',
          'DJ' => 'Djibouti',
          'DM' => 'Dominica',
          'DO' => 'Dominican Republic',
          'EC' => 'Ecuador',
          'EG' => 'Egypt',
          'SV' => 'El Salvador',
          'GQ' => 'Equatorial Guinea',
          'ER' => 'Eritrea',
          'EE' => 'Estonia',
          'ET' => 'Ethiopia',
          'EZ' => 'Eurozone',
          'FK' => 'Falkland Islands',
          'FO' => 'Faroe Islands',
          'FJ' => 'Fiji',
          'FI' => 'Finland',
          'FR' => 'France',
          'GF' => 'French Guiana',
          'PF' => 'French Polynesia',
          'TF' => 'French Southern Territories',
          'GA' => 'Gabon',
          'GM' => 'Gambia',
          'GE' => 'Georgia',
          'DE' => 'Germany',
          'GH' => 'Ghana',
          'GI' => 'Gibraltar',
          'GR' => 'Greece',
          'GL' => 'Greenland',
          'GD' => 'Grenada',
          'GP' => 'Guadeloupe',
          'GU' => 'Guam',
          'GT' => 'Guatemala',
          'GG' => 'Guernsey',
          'GN' => 'Guinea',
          'GW' => 'Guinea-Bissau',
          'GY' => 'Guyana',
          'HT' => 'Haiti',
          'HN' => 'Honduras',
          'HK' => 'Hong Kong SAR China',
          'HU' => 'Hungary',
          'IS' => 'Iceland',
          'IN' => 'India',
          'ID' => 'Indonesia',
          'IR' => 'Iran',
          'IQ' => 'Iraq',
          'IE' => 'Ireland',
          'IM' => 'Isle of Man',
          'IL' => 'Israel',
          'IT' => 'Italy',
          'JM' => 'Jamaica',
          'JP' => 'Japan',
          'JE' => 'Jersey',
          'JO' => 'Jordan',
          'KZ' => 'Kazakhstan',
          'KE' => 'Kenya',
          'KI' => 'Kiribati',
          'XK' => 'Kosovo',
          'KW' => 'Kuwait',
          'KG' => 'Kyrgyzstan',
          'LA' => 'Laos',
          'LV' => 'Latvia',
          'LB' => 'Lebanon',
          'LS' => 'Lesotho',
          'LR' => 'Liberia',
          'LY' => 'Libya',
          'LI' => 'Liechtenstein',
          'LT' => 'Lithuania',
          'LU' => 'Luxembourg',
          'MO' => 'Macau SAR China',
          'MK' => 'Macedonia',
          'MG' => 'Madagascar',
          'MW' => 'Malawi',
          'MY' => 'Malaysia',
          'MV' => 'Maldives',
          'ML' => 'Mali',
          'MT' => 'Malta',
          'MH' => 'Marshall Islands',
          'MQ' => 'Martinique',
          'MR' => 'Mauritania',
          'MU' => 'Mauritius',
          'YT' => 'Mayotte',
          'MX' => 'Mexico',
          'FM' => 'Micronesia',
          'MD' => 'Moldova',
          'MC' => 'Monaco',
          'MN' => 'Mongolia',
          'ME' => 'Montenegro',
          'MS' => 'Montserrat',
          'MA' => 'Morocco',
          'MZ' => 'Mozambique',
          'MM' => 'Myanmar (Burma)',
          'NA' => 'Namibia',
          'NR' => 'Nauru',
          'NP' => 'Nepal',
          'NL' => 'Netherlands',
          'NC' => 'New Caledonia',
          'NZ' => 'New Zealand',
          'NI' => 'Nicaragua',
          'NE' => 'Niger',
          'NG' => 'Nigeria',
          'NU' => 'Niue',
          'NF' => 'Norfolk Island',
          'KP' => 'North Korea',
          'MP' => 'Northern Mariana Islands',
          'NO' => 'Norway',
          'OM' => 'Oman',
          'PK' => 'Pakistan',
          'PW' => 'Palau',
          'PS' => 'Palestinian Territories',
          'PA' => 'Panama',
          'PG' => 'Papua New Guinea',
          'PY' => 'Paraguay',
          'PE' => 'Peru',
          'PH' => 'Philippines',
          'PN' => 'Pitcairn Islands',
          'PL' => 'Poland',
          'PT' => 'Portugal',
          'PR' => 'Puerto Rico',
          'QA' => 'Qatar',
          'RE' => 'Réunion',
          'RO' => 'Romania',
          'RU' => 'Russia',
          'RW' => 'Rwanda',
          'WS' => 'Samoa',
          'SM' => 'San Marino',
          'ST' => 'São Tomé & Príncipe',
          'SA' => 'Saudi Arabia',
          'SN' => 'Senegal',
          'RS' => 'Serbia',
          'SC' => 'Seychelles',
          'SL' => 'Sierra Leone',
          'SG' => 'Singapore',
          'SX' => 'Sint Maarten',
          'SK' => 'Slovakia',
          'SI' => 'Slovenia',
          'SB' => 'Solomon Islands',
          'SO' => 'Somalia',
          'ZA' => 'South Africa',
          'GS' => 'South Georgia & South Sandwich Islands',
          'KR' => 'South Korea',
          'SS' => 'South Sudan',
          'ES' => 'Spain',
          'LK' => 'Sri Lanka',
          'BL' => 'St. Barthélemy',
          'SH' => 'St. Helena',
          'KN' => 'St. Kitts & Nevis',
          'LC' => 'St. Lucia',
          'MF' => 'St. Martin',
          'PM' => 'St. Pierre & Miquelon',
          'VC' => 'St. Vincent & Grenadines',
          'SD' => 'Sudan',
          'SR' => 'Suriname',
          'SJ' => 'Svalbard & Jan Mayen',
          'SZ' => 'Swaziland',
          'SE' => 'Sweden',
          'CH' => 'Switzerland',
          'SY' => 'Syria',
          'TW' => 'Taiwan',
          'TJ' => 'Tajikistan',
          'TZ' => 'Tanzania',
          'TH' => 'Thailand',
          'TL' => 'Timor-Leste',
          'TG' => 'Togo',
          'TK' => 'Tokelau',
          'TO' => 'Tonga',
          'TT' => 'Trinidad & Tobago',
          'TA' => 'Tristan da Cunha',
          'TN' => 'Tunisia',
          'TR' => 'Turkey',
          'TM' => 'Turkmenistan',
          'TC' => 'Turks & Caicos Islands',
          'TV' => 'Tuvalu',
          'UM' => 'U.S. Outlying Islands',
          'VI' => 'U.S. Virgin Islands',
          'UG' => 'Uganda',
          'UA' => 'Ukraine',
          'AE' => 'United Arab Emirates',
          'GB' => 'United Kingdom',
          'UN' => 'United Nations',
          'US' => 'United States',
          'UY' => 'Uruguay',
          'UZ' => 'Uzbekistan',
          'VU' => 'Vanuatu',
          'VA' => 'Vatican City',
          'VE' => 'Venezuela',
          'VN' => 'Vietnam',
          'WF' => 'Wallis & Futuna',
          'EH' => 'Western Sahara',
          'YE' => 'Yemen',
          'ZM' => 'Zambia',
          'ZW' => 'Zimbabwe',
        );
    }
}
