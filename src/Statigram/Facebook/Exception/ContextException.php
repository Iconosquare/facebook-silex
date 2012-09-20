<?php

namespace Statigram\Facebook\Exception;

/**
 * Facebook application context exception
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class ContextException extends FacebookException
{
	public function __construct($message)
	{
		parent::__construct(400, $message);
	}
}
