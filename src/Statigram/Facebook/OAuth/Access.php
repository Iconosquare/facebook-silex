<?php

namespace Statigram\Facebook\OAuth;

/**
 * Facebook access
 *
 * Represent a facebook OAuth access token
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Access
{
	private $token;
	private $delay;
	private $expires;

	/**
	 * Constructor
	 *
	 * @param string $token   OAuth Access token
	 * @param int    $issued  Current time on the remote server as unix timestamp
	 * @param int    $expires Token expiration time on the remote server as unix timestamp
	 */
	public function __construct($token = null, $issued = null, $expires = null)
	{
		$this->token = $token;
		$this->delay = time() - (int) $issued;
		$this->expires = (int) $expires;
	}

	/**
	 * Return the OAuth access  token
	 *
	 * @return string 
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * Check whether the access is expired
	 *
	 * @return boolean
	 */
	public function isExpired()
	{
		return ($this->expires + $this->delay) > time();
	}

	/**
	 * Return the local expiration time
	 *
	 * @param string $format A DateTime format
	 *
	 * @return int|string
	 */
	public function expiresAt($format = null)
	{
		$local = $this->expires + $this->delay;

		if (null !== $format) {
			$datetime = new \DateTime();
			$datetime->setTimestamp($local);

			$local = $datetime->format($format); 
		}

		return $local;
	}
}