<?php

namespace Statigram\Facebook\Model;

use Statigram\Facebook\OAuth\Access;

/**
 * Facebook user
 *
 * Could be easily converted to trait for php 5.4
 * May be completed with a User Graph API resource 
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class User
{
	/**
	 * @var string Facebook user id
	 */
	private $id;

	/**
	 * @var string Facebook iso country code
	 */
	private $country;

	/**
	 * @var string Facebook email
	 */
	private $email;

	/**
	 * @var string Facebook iso locale code
	 */
	private $locale;

	/**
	 * @var \Statigram\Facebook\oAuth\Access Facebook OAuth access token
	 */
	private $access;

	/**
	 * Return the Facebook user id
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Define the Facebook user id
	 *
	 * @param string $id
	 */

	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Return the Facebook user email
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Define the Facebook user email
	 *
	 * @param string
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Return the Facebook iso country code
	 *
	 * @return string
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * Define the Facebook iso country code 
	 *
	 * @param string
	 */
	public function setCountry($country)
	{
		$this->country = $country;
	}

	/**
	 * Return the Facebook user iso locale code
	 *
	 * @return string
	 */
	public function getLocale()
	{
		return $this->locale;
	}

	/**
	 * Define the Facebook iso locale code
	 *
	 * @param string
	 */
	public function setLocale($locale)
	{
		$this->locale = $locale;
	}

	/**
	 * Check whether the Facebook user has an OAuth access token
	 *
	 * @return boolean
	 */
	public function hasAccess()
	{
		return $this->access instanceof Access;
	}

	/**
	 * Return the Facebook user OAuth access token
	 *
	 * @return \Statigram\Facebook\oAuth\Access
	 */
	public function getAccess()
	{
		return $this->access;
	}

    /**
     * @param Access $access
     */
    public function setAccess(Access $access)
	{
		$this->access = $access;
	}
}