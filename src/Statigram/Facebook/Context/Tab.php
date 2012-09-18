<?php

namespace Statigram\Facebook\Context;

use Statigram\Facebook\Model\User;
use Statigram\Facebook\Model\Page;

/**
 * Facebook Tab Context
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Tab extends Context
{
	/**
	 * @var Statigram\Facebook\Page;
	 */
	private $page;

	public function __construct(User $user, Page $page)
	{
		parent::__construct($user);
		$this->setPage($page);
	}

	/**
	 * Return the Facebook page
	 *
	 * @return Statigram\Facebook\Page
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * Define the Facebook page
	 *
	 * @return Statigram\Facebook\Page
	 */
	public function setPage(Page $page)
	{
		$this->page = $page;
	}
}