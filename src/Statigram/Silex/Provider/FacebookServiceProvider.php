<?php

namespace Statigram\Silex\Provider;

use Statigram\Facebook\Application;
use Statigram\Facebook\Client;
use Statigram\Facebook\Context\ContextFactory;
use Statigram\Silex\Listener\FacebookListener;
use Silex\Application as SilexApplication;
use Silex\ServiceProviderInterface;


/**
 * Facebook Silex Service Provider
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class FacebookServiceProvider implements ServiceProviderInterface
{
    public function register(SilexApplication $app)
    {   
        $config = $app['config_app']['facebook'];

        $app['facebook'] = $app->share(function () use ($app, $config) {

            return new Application($config['id'], $config['secret'], $config['url']['canvas'], $config['scopes'], $app['session'], $app['facebook.client']);
        });

        $app['facebook.client'] = $app->share(function () use ($app, $config) {

            return new Client($app['session'], $config['id'], $config['secret']);
        });

        $app['facebook.context_factory'] = $app->share(function () use ($app) {

            return new ContextFactory();
        });

    }

    public function boot(SilexApplication $app)
    {
        $app['dispatcher']->addSubscriber(new FacebookListener($app['facebook.context_factory'], $app['facebook.client'], $app['facebook'], $app['logger']));
    }
}

