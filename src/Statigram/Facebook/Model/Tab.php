<?php

namespace Statigram\Facebook\Model;

/**
 * Facebook tab class
 *
 * @author Ludovic Fleury <ludo.fleury@gmail.com>
 */
class Tab
{
	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $link;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $position;

	/**
	 * @var Statigram\Facebook\Model\Application
	 */
	private $application;

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

	public function getLink()
	{
		return $this->link;
	}

	public function setLink($link)
	{
		$this->link = $link;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getPosition()
	{
		return $this->position;
	}

	public function setPosition($position)
	{
		$this->position = $position;
	}

	public function getApplication(Application $application)
	{
		return $this->application;
	}

	public function setApplication($application)
	{
		$this->application = $application;
	}
}
