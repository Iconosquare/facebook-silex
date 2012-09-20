<?php

namespace Statigram\Facebook;

use Statigram\Facebook\Http\RedirectResponse;
use Statigram\Facebook\Model\Application as BaseApplication;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Application extends BaseApplication
{
	private $session;
	private $client;

	public function __construct($id, $secret, $canvasUrl, array $scopes, SessionInterface $session, Client $client)
	{
		parent::__construct($id, $secret, $canvasUrl, $scopes);
		$this->session = $session;
		$this->client = $client;
	}

	/**
	 * Check whether the application is loaded in a Facebook Canvas
	 *
	 * @return boolean 
	 */
	public function isCanvas()
	{
		return 'canvas' === $this->getContext()->getType();
	}

	/**
	 * Check whether the application is loaded in a Facebook Tab
	 *
	 * @return boolean 
	 */
	public function isTab()
	{
		return 'tab' === $this->getContext()->getType(); 
	}

	/**
	 * Build & return an absolute facebook authorization url
	 *
	 * Without parameters, the redirect uri is set to the facebook canvas url (apps.facebook.com/...)
	 *
	 * @param string $redirectUri (Optional) An absolute url to be redirected 
	 *
	 * @return string 
	 */
	public function getAuthorizationUrl($redirectUri = null)
	{
		$parameters = array();
		$parameters['redirect_uri'] = (null !== $redirectUri) ? $redirectUri : $this->getCanvasUrl();
    	$parameters['scope'] = $this->getScopes(true);

		return $this->client->getLoginUrl($parameters);
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
		return $this->redirect($this->getAuthorizationUrl($redirectUri));
	}

	/**
	 * Check whether the Facebook application is authorized by the current user
	 *
	 * @return boolean
	 */
	public function isAuthorized()
	{
		return $this->getContext()->getUser()->hasAccess();
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
		return $this->client->getPermissions();
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
		$granted = $this->getPermissions();

        foreach ($permissions as $permission) {
            if (isset($granted[$permission]) && $granted[$permission] === 1) {
            	return true;
            }
        }

        return false;
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
        $granted = $this->getPermissions();
        $missing = array();

        foreach ($permissions as $permission) {
            if (!isset($granted[$permission]) || $granted[$permission] !== 1) {
               $missing[] = $permission;
            }
        }

        return $missing;
	}

	/**
	 * Return a javascript redirect reponse
	 *
	 * Facebook context load the application in a iframe and requires a special redirection
	 * @see https://developers.facebook.com/docs/authentication/canvas/ §2a. Redirect to OAuth Dialog upon page load
	 *
	 * @return Statigram\Facebook\Response
	 */
	public function redirect($url)
	{
		return new RedirectResponse($url);
	}

	/**
	 * Check whether the Facebook context is defined
	 *
	 * @return boolean
	 */
	public function hasContext()
	{
		return $this->session->has('facebook');
	}

	/**
	 * Set Facebook context
	 *
	 * @param string|null $context
	 */
	public function setContext($context)
	{
		$this->session->set('facebook', $context);
	}

	/**
	 * Retrieve the Facebook context
	 *
	 * @return string
	 */
	public function getContext()
	{
		return $this->session->get('facebook');
	}
}
