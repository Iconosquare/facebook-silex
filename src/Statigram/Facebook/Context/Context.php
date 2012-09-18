<?php

namespace Statigram\Facebook\Context;

use Statigram\Facebook\Model\User;

/**
 * Asbtract Facebook Context
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
abstract class Context
{
	/**
	 * @var Statigram\Facebook\User Current Facebook user
	 */
	private $user;

	public function __construct(User $user)
	{
		$this->setUser($user);
	}

	/**
	 * Return the Facebook user
	 *
	 * @return Statigram\Facebook\User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Define the Facebook user
	 *
	 * @param Statigram\Facebook\User
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}
}