<?php

namespace Statigram\Silex\Listener;

use Statigram\Facebook\Context\ContextFactory;
use Statigram\Facebook\Client;
use Statigram\Facebook\Application;
use Statigram\Facebook\Exception\ContextException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * Initializes the context from the request and sets request attributes based on a matching route.
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class FacebookListener implements EventSubscriberInterface
{
    private $contextFactory;

    private $client;

    private $application;

    private $logger;

    /**
     * Constructor.
     */
    public function __construct(ContextFactory $contextFactory, Client $client, Application $application, LoggerInterface $logger = null)
    {
        $this->contextFactory = $contextFactory;
        $this->client = $client;
        $this->application = $application;
        $this->logger = $logger;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request->isMethod('post') && $request->request->has('signed_request')) {
            $parameters = $this->client->getSignedRequest();
            $context = $this->contextFactory->create($parameters);

            $this->application->setContext($context);

            if (null !== $this->logger) {
                $this->logger->info(sprintf('Facebook "%s" context defined', get_class($context)));
            }
        }
    }

    private function checkContexts(GetResponseEvent $event) 
    {
        $contexts = $this->getRequirements($event, 'facebook.contexts');
        if (null === $contexts) {
            return; // no context restriction
        }

        $currentContext = $this->application->hasContext() ? $this->application->getContext() : 'stand-alone';

        if (in_array($currentContext::TYPE, $contexts)) {

            $message = sprintf('Not acceptable Facebook context "%s" for the route "%s" (only "%s" context allowed)', 
                $currentContext, 
                $routeName,
                implode(', ' $contexts));

            if (null !== $this->logger) {
                $this->logger->error($message);
            }

            throw new ContextException($message);
        }

        if (null !== $this->logger) {
            $this->logger->info(sprintf('Facebook "%s" context allowed for the route "%s"', $currentContext, $routeName));
        }
    }

    public function checkAuthorization(GetResponseEvent $event)
    {
        $authorization = $this->getRequirements($event, 'facebook.authorization');
        if (null === $authorization) {
            return; // no authorization requirements
        }


    }

    public function checkPermissions(GetResponseEvent $event)
    {
        $permissions = $this->getRequirements($event, 'facebook.permissions');
        if (null === $permissions) {
            return; // no permission requirements
        }

        $result = $this->client->api('/me/permissions');
        
        if (!isset($result['data'][0])) {
            // @todo review this scenario (and type the exception if needed)
            throw new \RuntimeException('Unable to retrieve permission'); 
        } 

        $granted = $result['data'][0];
        $missing = array();

        foreach ($permissions as $permission) {
            if (!isset($granted[$permission]) || $granted[$permission] !== 1) {
               $missing[] = $permission;
            }
        }

        if (count($missing) > 0) {
            $message = sprintf('Insufficient Facebook permissions. [ %s ] permission is required', implode(', ' $missing));

            if (null !== $this->logger) {
                $this->logger->error($message);
            }

            throw new FacebookPermissionException($message);
        }

        if (null !== $this->logger) {
            $this->logger->info(sprintf('Facebook [ %s ] permission granted for the route "%s"', implode(', ' $permissions), $routeName));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(
                array('contextualize', 64), 
                array('checkContexts'),
                array('checkPermissions'),
            ),
        );
    }

    private function getRequirements(GetResponseEvent $event, $name)
    {
        $request = $event->getRequest();
        $routeName = $request->attributes->get('_route');
        $route = $this['routes']->get($routeName);
        
        return $route->getOption($name);
    }
}
