<?php

namespace Statigram\Facebook;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Facebook php-sdk wrapper
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Client extends \Facebook
{
	protected static $allowedKeys = array('state', 'code', 'access_token', 'user_id');
	protected $session;

	public function __construct(SessionInterface $session, $id, $secret)
	{
		$this->session = $session;
		$this->session->start();
		parent::__construct(array('appId' => $id, 'secret' => $secret));
	}

	public function getUser($accessToken = null)
	{
		$content = $this->api('/me');

		if (!empty($content)) {
			return null;
		}

		$user = new Model\User();
		$user->setEmail($content['email']);

		return $user;
	}

	public function getPermissions()
	{
		$content = $this->api('/me/permissions');

        return $content['data'][0];
	}

    public function getPages()
	{
		$content = $this->api('/me/accounts');

		$pages = array();
		$pages = array_filter($content['data'], function($account) {
			return $account['category'] != 'Application';
		});

        return $pages;
	}

	/**
	 * Get an installed tab
	 *
	 * @see https://developers.facebook.com/docs/reference/api/page/#tabs §Testing App Installs
	 */
	public function getTab(Model\Page $page, Model\Application $application)
	{
		$url = sprintf('/%s/tabs/%s', $page->getId(), $application->getId());
		
		$content = $this->api($url);

		if (empty($content['data'])) {

			return null;
		}

		$application = new Model\Application($content['data']['application']['id']);
		$application->setName($content['data']['application']['name']);

		$tab = new Model\Tab($content['data']['id']);
		$tab->setName($content['data']['name']);
		$tab->setLink($content['data']['link']);
		$tab->setApplication($application);
		$tab->setPosition($content['data']['position']);
		
		return $tab;
	}

	public function addTab(Page $page, Application $application)
	{
		$url = sprintf('/%s/tabs', $page->getId());
		$parameters = array(
			'app_id' =>  $application->getId(),
			'access_token' => $page->getAccess()->getToken()
		);

		$content = $this->api($url, 'post', $parameters);
	}

	protected function setPersistentData($key, $value) 
	{
	    if (!in_array($key, self::$allowedKeys)) {
	      self::errorLog('Unsupported key passed to setPersistentData.');
	      return;
	    }

	    $formattedKey = $this->constructSessionVariableName($key);

	    $this->session->set($formattedKey, $value);
  	}

	protected function getPersistentData($key, $default = false) 
	{
		if (!in_array($key, self::$allowedKeys)) {
		  self::errorLog('Unsupported key passed to getPersistentData.');
		  return $default;
		}

		$formattedKey = $this->constructSessionVariableName($key);

		return $this->session->get($formattedKey, $default);
	}

	protected function clearPersistentData($key) 
	{
		if (!in_array($key, self::$allowedKeys)) {
		  self::errorLog('Unsupported key passed to clearPersistentData.');
		  return;
		}

		$formattedKey = $this->constructSessionVariableName($key);
		
		$this->session->remove($formattedKey);
	}

	protected function clearAllPersistentData() 
	{
		foreach (self::$allowedKeys as $key) {
			$this->clearPersistentData($key);
		}
	}

	protected function constructSessionVariableName($key) 
	{
		return 'facebook.'.$this->getAppId().'.client.'.$key;
	}
}
