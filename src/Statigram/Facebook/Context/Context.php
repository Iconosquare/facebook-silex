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
	 * @var \Statigram\Facebook\Model\User Current Facebook user
	 */
	private $user;

	public function __construct(User $user)
	{
		$this->setUser($user);
	}

	public function __toString()
	{
		return $this->getType();
	}

	/**
	 * Return the Facebook user
	 *
	 * @return \Statigram\Facebook\Model\User
	 */
	public function getUser()
	{
		return $this->user;
	}

    /**
     * @param User $user
     */
    public function setUser(User $user)
	{
		$this->user = $user;
	}

	abstract public function getType();
}