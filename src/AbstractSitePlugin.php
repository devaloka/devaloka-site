<?php
/**
 * Abstract Site Plugin
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Plugin\Site;

use Devaloka\Plugin\AbstractPlugin;
use Devaloka\Plugin\TranslatablePluginInterface;
use Devaloka\Plugin\TranslatablePluginTrait;
use Devaloka\DependencyInjection\ContainerAwareInterface;
use Devaloka\DependencyInjection\ContainerAwareTrait;

/**
 * Class AbstractSitePlugin
 *
 * @package Devaloka\Plugin\Site
 */
abstract class AbstractSitePlugin extends AbstractPlugin implements
    SiteInterface,
    TranslatablePluginInterface,
    ContainerAwareInterface
{
    use ContainerAwareTrait;
    use TranslatablePluginTrait;
}
