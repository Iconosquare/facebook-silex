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
	 * Return the context type
	 *
	 * Abstract implementation
	 * @see Statigram\Facebook\Context\Context
	 *
	 * @return string
	 */
	public function getType()
	{
		return 'tab';
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

	/**
	 * Check wheter the current user is admin of the page
	 *
	 * @return bool
	 */
	public function isManageable()
	{
		return true === $this->page->getAdmin();
	}
}