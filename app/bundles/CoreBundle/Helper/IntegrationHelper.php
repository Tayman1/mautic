<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\CoreBundle\Helper;

use Mautic\CoreBundle\Factory\MauticFactory;

/**
 * Helper class for supporting integration functions
 */
class IntegrationHelper
{

    /**
     * @var array
     */
    private static $addons = array();

    /**
     * @var MauticFactory
     */
    private $factory;

    /**
     * Flag if the addons have been loaded
     *
     * @var bool
     */
    private static $loaded = false;

    /**
     * @param MauticFactory $factory
     */
    public function __construct(MauticFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Check if a bundle is enabled
     *
     * @param string $bundle
     *
     * @return bool
     */
    public function isEnabled($bundle)
    {
        // Populate our addon cache if not present
        if (!static::$loaded) {
            /** @var \Mautic\IntegrationBundle\Entity\IntegrationRepository $repo */
            $repo = $this->factory->getModel('integration')->getRepository();
            $data = $repo->getBundleStatus();

            foreach ($data as $addon) {
                static::$addons[$addon['bundle']] = $addon['enabled'];
            }

            static::$loaded = true;
        }

        // Check if the bundle is registered
        if (isset(static::$addons[$bundle])) {
            return static::$addons[$bundle];
        }

        // If we don't know about the bundle, it isn't properly registered and we will always return false
        return false;
    }
}
