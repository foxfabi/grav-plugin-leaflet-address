<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class LeafletAddressShortcode extends Shortcode
{
    const NAME = 'leaflet-address';

    /*
     * Initialize, register and process shortcode [place] (Plugin Leaflet Address shortCode Embed)
     *
     * It will process following shortcodes:
     *   [place type="addr"]: display leaflet address (leaflet-address.html.twig)
     *   [place type="map"]:  display leaflet address map (leaflet-address-map.html.twig)
     *  @return string
     */
    public function init()
    {

        $this->shortcode->getHandlers()->add('place', function (ShortcodeInterface $sc) {
            $hash   = $this->shortcode->getId($sc);
            $type   = trim($sc->getParameter("type"));
            if (isset($type)) {
                $config = $this->config->get('plugins.' . self::NAME);
                switch ($type) {
                    case 'addr':
                        return $this->twig->processTemplate('partials/leaflet-address.html.twig', [
                            'config' => $config,
                            'hash' => $hash,
                        ]);
                        break;
                    case 'map':
                        return $this->twig->processTemplate('partials/leaflet-address-map.html.twig', [
                            'config' => $config,
                            'hash' => $hash,
                        ]);
                        break;
                }
            }
            return null;
        });
    }
}
