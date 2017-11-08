<?php

namespace Test;

use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/bootstrap.php';


class Test extends Tester\TestCase
{
	private $container;


	public function __construct(Nette\DI\Container $container)
	{
        $this->container = $container;
	}


	public function setUp()
	{
	}



	public function testUserManager()
	{

        $articleList = $this->container->getByType('VladimirBiro\ArticleManager\ArticleList');
        $return = $articleList->testTest();

        Assert::same('Hello John', $return);
	}

}



$test = new Test($container);
$test->run();
