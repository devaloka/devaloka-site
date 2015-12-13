<?php
/**
 * Sub
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Plugin\Site;

use Devaloka\Plugin\AbstractPlugin;
use Devaloka\Plugin\PluginInterface;
use Devaloka\Plugin\TranslatablePluginInterface;
use Devaloka\Plugin\TranslatablePluginTrait;
use Devaloka\DependencyInjection\ContainerAwareInterface;
use Devaloka\DependencyInjection\ContainerAwareTrait;

/**
 * Class Sub
 *
 * @package Devaloka\Plugin\Site
 */
class Sub extends AbstractPlugin implements PluginInterface, TranslatablePluginInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;
    use TranslatablePluginTrait;
}
