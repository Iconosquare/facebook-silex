<?php

namespace Statigram\Facebook\Exception;

use Symfony\Component\HttpKernel\HttpException;

/**
 * Facebook authorization exception
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class AuthorizationException extends HttpException
{
	public function __construct($message)
	{
		parent::__construct(403, $message);
	}
}
