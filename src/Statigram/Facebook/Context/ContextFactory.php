<?php

namespace Statigram\Facebook\Context;

use Statigram\Facebook\Context\Canvas;
use Statigram\Facebook\Context\Tab;
use Statigram\Facebook\Model\Page;
use Statigram\Facebook\Model\User;
use Statigram\Facebook\OAuth\Access;

/**
 * Facebook context factory
 *
 * Responsible for the creation of the whole Facebook context
 *
 * @see https://developers.facebook.com/docs/authentication/signed_request/
 */
class ContextFactory
{
	/**
     * Facebook context factory
     *
     * Define a Facebook context from a signed request
     * @see https://developers.facebook.com/docs/authentication/signed_request/
     *
     * @param array $parameters Facebook signed request parameters
     */
    public function create(array $parameters)
    {
    	$user = $this->createUser($parameters);

    	if (isset($parameters['page']) && isset($parameters['page']['id'])) {
    		$page = new Page($parameters['page']['id']);
    		$page->setAdmin($parameters['page']['admin']);
    		$page->setLiked($parameters['page']['liked']);

    		$context = new Tab($user, $page);
    	} else {
    		$context = new Canvas($user);
    	}

    	return $context;
    }

    /**
     * Create & authenticate a Facebook user 
     *
	 * @param array $parameters Facebook signed request parameters
     */
    public function createUser(array $parameters)
    {
    	$user = new User();
    	$user->setCountry($parameters['user']['country']);
    	$user->setLocale($parameters['user']['locale']);

    	// User has authorized the application
    	if (isset($parameters['user_id']) && isset($parameters['oauth_token'])) {
    		$access = new Access($parameters['oauth_token'], $parameters['issued_at'], $parameters['expires']);

    		$user->setId($parameters['user_id']);
    		$user->setAccess($access);
    	}

    	return $user;
    }
}