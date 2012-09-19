<?php

namespace Statigram\Facebook\Exception;

use Symfony\Component\HttpKernel\HttpException;

/**
 * Facebook context exception
 *
 * 
 */
class ContextException extends HttpException
{
	public function __construct($message)
	{
		parent::__construct(500, $message);
	}
}
