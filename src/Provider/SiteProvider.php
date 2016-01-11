<?php
/**
 * Site Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Plugin\Site\Provider;

use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Devaloka\Devaloka;
use Devaloka\Provider\ServiceProviderInterface;
use Devaloka\Provider\BootableProviderInterface;
use Devaloka\Provider\EventListenerProviderInterface;
use Devaloka\Component\DependencyInjection\ContainerInterface;
use Devaloka\Component\DependencyInjection\ContainerAwareInterface;
use Devaloka\Translation\TranslatorAwareInterface;
use Devaloka\Plugin\TranslatablePluginInterface;
use Devaloka\Plugin\ActivatablePluginInterface;
use Devaloka\Component\EventDispatcher\EventDispatcherAwareInterface;

/**
 * Class SiteProvider
 *
 * @package Devaloka\Plugin\Site\Provider
 * @author Whizark
 */
class SiteProvider implements ServiceProviderInterface, BootableProviderInterface, EventListenerProviderInterface
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        $container->add('devaloka.plugin.site.file', $this->file);

        // Main Plugin
        $container->add('devaloka.plugin.site.main.class', 'Devaloka\\Plugin\\Site\\Main');
        $container->add(
            'devaloka.plugin.site.main',
            function (Container $container) {
                $plugin = new $container['devaloka.plugin.site.main.class']($container['devaloka.plugin.site.file']);

                if ($plugin instanceof ContainerAwareInterface) {
                    $plugin->setContainer($container['container']);
                }

                if ($plugin instanceof TranslatorAwareInterface) {
                    $plugin->setTranslator($container['translator']);
                }

                return $plugin;
            }
        );

        // Sub Plugin
        $container->add('devaloka.plugin.site.sub.class', 'Devaloka\\Plugin\\Site\\Sub');
        $container->add(
            'devaloka.plugin.site.sub',
            function (Container $container) {
                $plugin = new $container['devaloka.plugin.site.sub.class']($container['devaloka.plugin.site.file']);

                if ($plugin instanceof ContainerAwareInterface) {
                    $plugin->setContainer($container['container']);
                }

                if ($plugin instanceof TranslatorAwareInterface) {
                    $plugin->setTranslator($container['translator']);
                }

                return $plugin;
            }
        );

        // Main Event Listener
        $container->add(
            'devaloka.plugin.site.main.site_listener.class',
            'Devaloka\\Plugin\\Site\\EventListener\\MainListener'
        );
        $container->add(
            'devaloka.plugin.site.main.site_listener',
            function (Container $container) {
                $plugin   = $container['devaloka.plugin.site.main'];
                $listener = new $container['devaloka.plugin.site.main.site_listener.class']($plugin);

                if ($listener instanceof EventDispatcherAwareInterface) {
                    $listener->setEventDispatcher($container['event_dispatcher']);
                }

                return $listener;
            }
        );

        // Sub Event Listener
        $container->add(
            'devaloka.plugin.site.sub.site_listener.class',
            'Devaloka\\Plugin\\Site\\EventListener\\SubListener'
        );
        $container->add(
            'devaloka.plugin.site.sub.site_listener',
            function (Container $container) {
                $plugin   = $container['devaloka.plugin.site.sub'];
                $listener = new $container['devaloka.plugin.site.sub.site_listener.class']($plugin);

                if ($listener instanceof EventDispatcherAwareInterface) {
                    $listener->setEventDispatcher($container['event_dispatcher']);
                }

                return $listener;
            }
        );

        // Plugin
        $container->add(
            'devaloka.plugin.site.type',
            function () {
                return is_main_site() ? 'main' : 'sub';
            }
        );

        $container->add(
            'devaloka.plugin.site',
            function (Container $container) {
                $type = $container['devaloka.plugin.site.type'];

                return $container['devaloka.plugin.site.' . $type];
            }
        );

        // Event Listener
        $container->add(
            'devaloka.plugin.site.site_listener.class',
            function (Container $container) {
                $type = $container['devaloka.plugin.site.type'];

                return $container['devaloka.plugin.site.' . $type . '.site_listener.class'];
            }
        );
        $container->add(
            'devaloka.plugin.site.site_listener',
            function (Container $container) {
                $type = $container['devaloka.plugin.site.type'];

                return $container['devaloka.plugin.site.' . $type . '.site_listener'];
            }
        );

        // Text Domain
        $container->add(
            'devaloka.plugin.site.text_domain',
            function (Container $container) {
                $type = $container['devaloka.plugin.site.type'];

                return 'devaloka-' . $type;
            }
        );
    }

    public function boot(Devaloka $devaloka, ContainerInterface $container)
    {
        $plugin = $container->get('devaloka.plugin.site');

        if ($plugin instanceof ActivatablePluginInterface) {
            $plugin->register();
        }

        if ($plugin instanceof TranslatablePluginInterface) {
            $domain = $container->get('devaloka.plugin.site.text_domain');

            $plugin->setTextDomain($domain);
            $plugin->loadTextDomain();
            $plugin->loadLocaleFile();
        }

        $plugin->boot();
    }

    public function subscribe(Devaloka $devaloka, ContainerInterface $container, EventDispatcherInterface $dispatcher)
    {
        $listener = $container->get('devaloka.plugin.site.site_listener');

        $dispatcher->addSubscriber($listener);
    }
}
