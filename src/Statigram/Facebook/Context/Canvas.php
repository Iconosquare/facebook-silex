<?php

namespace Statigram\Facebook\Context;

use Statigram\Facebook\Model\User;

/**
 * Facebook canvas context
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Canvas extends Context
{
	public function __contruct(User $user)
	{
		parent::__construct($user);
	}
}