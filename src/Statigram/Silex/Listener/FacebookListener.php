<?php

namespace Statigram\Silex\Listener;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Initializes the context from the request and sets request attributes based on a matching route.
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class FacebookListener implements EventSubscriberInterface
{
    /**
     * Constructor.
     */
    public function __construct(ContextFactory $contextFactory, Client $client, Application $application, LoggerInterface $logger = null)
    {
        $this->contextFactory = $contextFactory;
        $this->client = $client;
        $this->session = $session;
        $this->logger = $logger;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request->isMethod('post') && $request->request->has('signed_request')) {
            $parameters = $this->client->getSignedRequest();
            $context = $this->contextFactory->create($parameters);

            $application->setContext($context);

            if (null !== $this->logger) {
                $this->logger->info(sprintf('Facebook "%s" context defined', get_class($context)));
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 64)),
        );
    }
}
