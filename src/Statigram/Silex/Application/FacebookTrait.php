<?php

namespace Statigram\Silex\Application;

/**
 * Facebook silex application trait
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
trait FacebookTrait
{
	/**
	 * Return the Graph API client
	 *
	 * @return \Statigram\Facebook\Client
	 */
	public function getClient()
	{
		return $this['facebook.client'];
	}

	/**
	 * Return the Facebook application id
	 *
	 * @return string
	 */
	public function getId()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook'];

		return $facebook->getId();
	}

	/**
	 * Return the Facebook application secret
	 *
	 * @return string
	 */
	public function getSecret()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook'];

		return $facebook->getSecret();
	}

	/**
	 * Return the Facebook canvas url
	 *
	 * @return string
	 */
	public function getCanvasUrl()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook'];

		return $facebook->getCanvasUrl();
	}

	/**
	 * Check whether the Facebook context is defined
	 *
	 * @return boolean
	 */
	public function hasContext()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

		return $facebook->hasContext();
	}

	/**
	 * Set Facebook context
	 *
	 * @param string|null $context
	 */
	public function setContext($context)
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

        $facebook->setContext($context);
	}

	/**
	 * Retrieve the Facebook context
	 *
	 * @return string
	 */
	public function getContext()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

		return $facebook->getContext();
	}

	/**
	 * Check whether the application is loaded in a Facebook Canvas
	 *
	 * @return boolean
	 */
	public function isCanvas()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

		return $facebook->isCanvas();
	}

	/**
	 * Check whether the application is loaded in a Facebook Tab
	 *
	 * @return boolean
	 */
	public function isTab()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

		return $facebook->isTab();
	}

	/**
	 * Check whether the Facebook application is authorized by the current user
	 *
	 * @return boolean
	 */
	public function isAuthorized()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook'];

		return $facebook->isAuthorized();
	}

	/**
	 * Return the Facebook application permissions
	 *
	 * List of permissions allowed to this application by the current user
	 *
	 * @return array
	 */
	public function getPermissions()
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook'];

		return $facebook->getPermissions();
	}

	/**
	 * Check whether the Facebook application has a specific permission
	 *
	 * @param string $permission
	 *
	 * @return boolean
	 */
	public function hasPermission($permission)
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook'];

		return $facebook->hasPermission($permission);
	}

	/**
	 * Check whether the Facebook application has some permissions
	 *
	 * Return an array of "missing" permissions
	 * Don't check the return value in a boolean fashion-way
	 * because an empty array mean all permissions are granted.
	 *
	 * @param array $permissions
	 *
	 * @return array $missing
	 */
	public function validatePermissions(array $permissions)
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook'];

		return $facebook->validatePermissions($permissions);
	}

	/**
	 * Return the Facebook authorization absolute url
	 *
	 * @param string $redirectUri
	 *
	 * @return string
	 */
	public function getAuthorizationUrl($redirectUri = null)
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

		return $facebook->getAuthorizationUrl($redirectUri);
	}

    /**
     * @param null $redirectUri
     * @return \Statigram\Facebook\Http\RedirectResponse
     */
    public function requestAuthorization($redirectUri = null)
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

		return $facebook->authorize($redirectUri);
	}

    /**
     * @param $url
     * @return \Statigram\Facebook\Http\RedirectResponse
     */
    public function redirectFacebook($url)
	{
        /** @var \Statigram\Facebook\Application $facebook */
        $facebook = $this['facebook.application'];

		return $facebook->redirect($url);
	}
}