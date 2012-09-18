<?php

namespace Statigram\Facebook;

/**
 * Facebook php-sdk wrapper
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Client extends \Facebook
{
	public function __construct(array $parameters)
	{
		parent::__construct($parameters);
	}

	/**
	 * Return a response which trigger the authentification process
	 *
	 * @return Response A special response which forces the pages/canvas to be refreshed to the authentification location
	 */
	public function authentification()
	{
		return new Response(sprintf("<script>top.location.href='%s'</script>", $this->getSigninUrl()));
	}

    public function getPages()
	{
		$accounts = $this->api('/me/accounts');

		$pages = array();
		
		$pages = array_filter($accounts['data'], function($account) {
			return $account['category'] != 'Application';
		});

        return $pages;
	}
}
