<?php

namespace Statigram\Silex\Provider;

use Statigram\Facebook\Manager;
use Statigram\Facebook\Client;
use Statigram\Facebook\Context\ContextFactory;
use Statigram\Silex\Listener\FacebookListener;
use Silex\Application;
use Silex\ServiceProviderInterface;


/**
 * Facebook Silex Service Provider
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class FacebookServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $config = $app['config_app']['facebook'];

        $app['facebook'] = $app->share(function () use ($app, $config) {

            return new Manager($config['id'], $config['secret'], $config['url']['canvas'], $config['scopes'], $app['session'], $app['facebook.client']);
        });

        $app['facebook.client'] = $app->share(function () use ($app, $config) {

            return new Client($config['id'], $config['secret'], $config['scopes']);
        });

        $app['facebook.context_factory'] = $app->share(function () use ($app) {

            return new ContextFactory();
        });

        $app['dispatcher']->addSubscriber(new FacebookListener($app['facebook.context_factory'], $app['facebook.client'], $app['facebook'], $app['logger']));
    }

    public function boot(Application $app)
    {
    }
}

