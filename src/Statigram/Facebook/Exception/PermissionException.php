<?php

namespace Statigram\Facebook\Exception;

/**
 * Facebook application permission exception
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class PermissionException extends FacebookException
{
	public function __construct($message)
	{
		parent::__construct(403, $message);
	}
}
