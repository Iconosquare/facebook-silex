<?php

namespace Statigram\Facebook\Model;

use Symfony\Component\HttpFoundation\Session;

/**
 * Facebook application
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Application
{
	/**
	 * @var string Facebook application id
	 */
	private $id;

	/**
	 * @var string Facebook application name
	 */
	private $name;

	/**
	 * @var string Facebook application secret
	 */
	private $secret;

	/**
	 * @var string Facebook canvas absolute url
	 */
	private $canvasUrl;

	/**
	 * @var array Facebook minimum scopes required
	 */
	private $scopes;

	public function __construct($id)
	{
		$this->setId($id);
	}

	/**
	 * Return the Facebook application id
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Define the Facebook application id
	 *
	 * @return string
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Return the Facebook application name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Define the Facebook application name
	 *
	 * @return string
	 */
	public function setName($name)
	{
		$this->name = $name;
	}	

	/**
	 * Return the Facebook application secret
	 *
	 * @return string
	 */
	public function getSecret()
	{
		return $this->secret;
	}

	/**
	 * Define the Facebook application secret
	 *
	 * @param string $secret
	 */
	public function setSecret($secret)
	{
		$this->secret = $secret;
	}

	/**
	 * Return the minimum Facebook scopes required
	 *
	 * @param bool $inline True to return an OAuth RFC compliant scopes list
	 *
	 * @return array|string
	 */
	public function getScopes($inline = false)
	{
		return ($inline) ? implode(',', $this->scopes) : $this->scopes; 
	}

	/**
	 * Define the minimum Facebook scopes required
	 *
	 * @param string|array OAuth RFC compliant scopes list or array
	 */
	public function setScopes($scopes)
	{
		if (is_string($scopes)) {
			$scopes = explode(',', $scopes);
		}

		$this->scopes = $scopes;
	}

	/**
	 * Return the facebook canvas absolute url (apps.facebook.com/...)
	 *
	 * @return string
	 */
	public function getCanvasUrl()
	{
		return $this->canvasUrl;
	}

	/**
	 * Define the Facebook canvas absolute url (apps.facebook.com/...)
	 *
	 * @param string
	 */
	public function setCanvasUrl($url)
	{
		$this->canvasUrl = $url;
	}
}
