<?php

namespace Statigram\Facebook\Exception;

/**
 * Facebook application authorization exception
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class AuthorizationException extends FacebookException
{
	public function __construct($message)
	{
		parent::__construct(403, $message);
	}
}
