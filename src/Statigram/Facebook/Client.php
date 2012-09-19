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

	public function getPermissions()
	{
		$result = $this->api('/me/permissions');
		if (!isset($result['data'][0])) {
            // @todo review this scenario (and type the exception if needed)
            throw new \RuntimeException('Unable to retrieve permission'); 
        }

        return $result['data'][0];
	}

    public function getPages()
	{
		$accounts = $this->api('/me/accounts');

		$pages = array();
		
		$pages = array_filter($accounts['data'], function($account) {
			return $account['category'] != 'Application';
		});

        return $pages;
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
		return 'facebook.client.'.(($this->sharedSessionID) ?: null ).$this->getAppId().$key;
	}
}
