<?php
namespace AppBundle\Tests\Controller;

use ApiLib\Tests\Fixtures\Article;
use ApiLib\Collection\ArticleCollection;

class ArticleCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $articleEntity = new Article();
        $this->assertInstanceOf('\ApiLib\Interfaces\ArticleRepositoryInterface', $articleEntity);
        $collection = new ArticleCollection($articleEntity);
        $this->assertInternalType('array', $collection->all());
        $this->assertEquals(4, count($collection->all()));
    }
}