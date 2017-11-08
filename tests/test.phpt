<?php

namespace Test;

use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/bootstrap.php';


class Test extends Tester\TestCase
{
    private $container;
    private $articleList;


    public function __construct(Nette\DI\Container $container)
    {
        $this->container = $container;
        $this->articleList = $this->container->getByType('VladimirBiro\ArticleManager\ArticleList');
    }


    public function setUp()
    {
        $this->articleList->setArticles();
    }



    public function testUserManager()
    {
        $return = $this->articleList->getArticleList();
        Assert::same('Hello World', $return);
    }

}



$test = new Test($container);
$test->run();
