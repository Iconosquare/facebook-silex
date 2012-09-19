<?php

namespace Statigram\Silex\Route;

/**
* Facebook contextualizable route trait
*
* Define contexts constraints for a route
* which can be used/check in a controller, middleware, etc.
* @see Statigram\Facebook\Listener::onKernelLateRequest()
*
* @author Ludovic Fleury <ludo.fleury@gmail.com>
*/
trait FacebookRouteTrait
{
    /**
     * Add facebook authorization requirement
     */
    public function requireAuthorization()
    {
        $this->setOption('facebook.authorization', true);

        return $this;
    }

    /**
     * Add context options for a route
     *
     * @param string $context
     */
    public function contextualize($context)
    {
    	$contexts = $this->getOption('facebook.contexts');

        $contexts[] = trim((string) $context);

        $this->setOption('facebook.contexts', $contexts);

        return $this;
    }
}