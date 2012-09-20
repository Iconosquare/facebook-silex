<?php

namespace Statigram\Facebook\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Facebook exception
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class FacebookException extends HttpException
{
	public function __construct($code, $message)
	{
		parent::__construct($code, $message);
	}
}
