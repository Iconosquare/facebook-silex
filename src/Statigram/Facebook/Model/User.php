<?php

namespace Statigram\Facebook\Model;

/**
 * Facebook user
 *
 * Represent a facebook user from an signed_request
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
	 * @var string Facebook iso locale code
	 */
	private $locale;

	/**
	 * @var Statigram\Facebook\Access Facebook OAuth access token
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
	 * @return Statigram\Facebook\Access
	 */
	public function getAccess()
	{
		return $this->access;
	}

	/**
	 * Define the Facebook user OAuth access token
	 *
	 * @param Statigram\Facebook\Access
	 */
	public function setAccess(Access $access)
	{
		$this->access = $access;
	}
}