<?php

namespace Playbloom\Test\Unit;

use mageekguy\atoum\test as AtoumTest,
    mageekguy\atoum\factory;

/**
* Base test class
*
* @author Ludovic Fleury <ludo.fleury@gmail.com>
*/
abstract class Test extends AtoumTest
{
    public function __construct(factory $factory = null)
    {
        $this->setTestNamespace('\\Test\\Unit\\');
        parent::__construct($factory);
    }
}