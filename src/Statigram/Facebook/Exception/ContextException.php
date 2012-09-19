<?php

namespace Statigram\Facebook\Exception;

use Symfony\Component\HttpKernel\HttpException;

/**
 * Facebook context exception
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class ContextException extends HttpException
{
	public function __construct($message)
	{
		parent::__construct(400, $message);
	}
}