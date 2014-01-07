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
	 * @return Statigram\Facebook\Client
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
		return $this['facebook']->getId();
	}

	/**
	 * Return the Facebook application secret
	 *
	 * @return string
	 */
	public function getSecret()
	{
		return $this['facebook']->getSecret();
	}

	/**
	 * Return the Facebook canvas url
	 *
	 * @return string
	 */
	public function getCanvasUrl()
	{
		return $this['facebook']->getCanvasUrl();
	}

	/**
	 * Check whether the Facebook context is defined
	 *
	 * @return boolean
	 */
	public function hasContext()
	{
		return $this['facebook.application']->hasContext();
	}

	/**
	 * Set Facebook context
	 *
	 * @param string|null $context
	 */
	public function setContext($context)
	{
		$this['facebook.application']->setContext($context);
	}

	/**
	 * Retrieve the Facebook context
	 *
	 * @return string
	 */
	public function getContext()
	{
		return $this['facebook.application']->getContext();
	}

	/**
	 * Check whether the application is loaded in a Facebook Canvas
	 *
	 * @return boolean
	 */
	public function isCanvas()
	{
		return $this['facebook.application']->isCanvas();
	}

	/**
	 * Check whether the application is loaded in a Facebook Tab
	 *
	 * @return boolean
	 */
	public function isTab()
	{
		return $this['facebook.application']->isTab();
	}

	/**
	 * Check whether the Facebook application is authorized by the current user
	 *
	 * @return boolean
	 */
	public function isAuthorized()
	{
		return $this['facebook']->isAuthorized();
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
		return $this['facebook']->getPermissions();
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
		return $this['facebook']->hasPermission($permission);
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
		return $this['facebook']->validatePermissions($permissions);
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
		return $this['facebook.application']->getAuthorizationUrl($redirectUri);
	}

	/**
	 * Request a facebook authorization from an user
	 *
	 * Return a special redirection response for facebook to the authorization endpoint
	 *
	 * @return Statigram\Facebook\Response
	 */
	public function requestAuthorization($redirectUri = null)
	{
		return $this['facebook.application']->authorize($redirectUri);
	}

	/**
	 * Return a javascript redirect reponse
	 *
	 * Facebook context load the application in a iframe and requires a special redirection
	 * @see https://developers.facebook.com/docs/authentication/canvas/ §2a. Redirect to OAuth Dialog upon page load
	 *
	 * @return Statigram\Facebook\Response
	 */
	public function redirectFacebook($url, $context = '')
	{
		return $this['facebook.application']->redirect($url);
	}
}