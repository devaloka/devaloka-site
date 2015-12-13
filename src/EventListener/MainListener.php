<?php
/**
 * Main Listener
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
 * Class MainListener
 *
 * @package Devaloka\Plugin\Site\EventListener
 */
class MainListener implements EventSubscriberInterface, EventDispatcherAwareInterface
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
        /** @var \Devaloka\Plugin\Site\Main $plugin */
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
