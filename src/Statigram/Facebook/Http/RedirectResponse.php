<?php

namespace Statigram\Facebook\Http;

use Symfony\Component\HttpFoundation\Response;

/**
 * Facebook Redirect Response
 *
 * Javascript redirect response for Facebook
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class RedirectResponse extends Response
{
	/**
	 * Constructor
	 *
	 * @param string $url An absolute url
	 */
	public function __construct($url, $context = '')
	{
		if (strpos($url, 'http') !== 0 && substr($url, 0, 2) !== '//') {
			throw new \InvalidArgumentException(sprintf('Invalid url: the url "%s" is not an absolute HTTP url / context: %s', $url, $context));
		}

		parent::__construct(sprintf("<script>top.location.href='%s'</script>", $url));
	}
}