<?php

namespace Statigram\Facebook\Exception;

use Symfony\Component\HttpKernel\HttpException;

/**
 * Facebook permission exception
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class PermissionException extends HttpException
{
	public function __construct($message)
	{
		parent::__construct(403, $message);
	}
}
