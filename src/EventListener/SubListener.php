<?php
/**
 * Sub Listener
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Plugin\Site\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Devaloka\EventDispatcher\EventDispatcherAwareInterface;
use Devaloka\EventDispatcher\EventDispatcherAwareTrait;
use Devaloka\Plugin\PluginInterface;

/**
 * Class SubListener
 *
 * @package Devaloka\Plugin\Site\EventListener
 */
class SubListener implements EventSubscriberInterface, EventDispatcherAwareInterface
{
    use EventDispatcherAwareTrait;

    /**
     * @var PluginInterface
     */
    private $plugin;

    /**
     * @param PluginInterface $plugin
     */
    public function __construct(PluginInterface $plugin)
    {
        /** @var \Devaloka\Plugin\Site\Sub $plugin */
        $this->plugin = $plugin;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [];
    }
}
