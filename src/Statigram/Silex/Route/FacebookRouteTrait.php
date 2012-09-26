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
     * Add Facebook application context requirements 
     *
     * @param array $contexts
     */
    public function restrictContexts(array $contexts)
    {
        $this->addArrayOption('facebook.contexts', $contexts);

        return $this;
    }

    /**
     * Add Facebook application authorization requirement
     */
    public function requireAuthorization()
    {
        $this->setOption('facebook.authorization', true);

        return $this;
    }

    /**
     * Add Facebook application permissions requirements
     *
     * @param array $permissions
     */
    public function requirePermissions(array $permissions)
    {
        $this->addArrayOption('facebook.permissions', $permissions);

        return $this;
    }

    /**
     * Add Facebook application page admin requirements
     */
    public function requirePageAdmin()
    {
        $this->setOption('facebook.page_admin', true);

        if (count($contexts) !== 1 || !in_array('page', $contexts)) {
            throw new \RuntimeException('Unable to require a Facebook page administrator: the route must be restricted to a page context only');
        }

        return $this;
    }

    /**
     * Add an array of values to an option
     *
     * @param string $key
     * @param array  $values
     */
    private function addArrayOption($key, array $values)
    {
        $options = $this->getOption($key);
        if (null === $options) {
            $options = array();
        }

        foreach ($values as $value) {
            $safeValue = trim((string) $value);

            $options[$safeValue] = $safeValue;
        }

        $this->setOption($key, $options);
    }
}