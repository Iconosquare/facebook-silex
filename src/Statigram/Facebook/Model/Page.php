<?php

namespace Statigram\Facebook\Model;

/**
 * Facebook page
 * 
 * Represent a Facebook page from a signed request
 * It could be improved and completed from a Page resource in the Graph API
 * @see https://developers.facebook.com/docs/authentication/pagetab/
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Page
{
	private $id;
	private $admin;
	private $liked;

	public function __construct($id)
	{
		$this->setId($id);
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getAdmin()
	{
		return $this->admin;
	}

	public function setAdmin($admin)
	{
		$this->admin = $admin;
	}

	public function getLiked()
	{
		return $this->liked;
	}

	public function setLiked($liked)
	{
		$this->liked = $liked;
	}
}