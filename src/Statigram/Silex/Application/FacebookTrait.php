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
	 * @return PlayBloom\Facebook\Client
	 */
	public function getClient()
	{
		return $this['facebook.client'];
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
	public function authorize($redirectUri = null)
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
	public function redirectFacebook($url)
	{
		return return $this['facebook.application']->redirect($url);
	}
}