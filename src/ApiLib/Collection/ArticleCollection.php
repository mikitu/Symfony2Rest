<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 07/04/2016
 * Time: 06:52
 */

namespace ApiLib\Collection;


use ApiLib\Interfaces\ArticleCollectionInterface;
use ApiLib\Interfaces\ArticleRepositoryInterface;

class ArticleCollection implements ArticleCollectionInterface
{
    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var int
     */
    protected $limit = 20;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleEntity;

    public function __construct(ArticleRepositoryInterface $articleEntity)
    {
        $this->articleEntity = $articleEntity;
    }

    /**
     * @param $page
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    
    public function all()
    {
        return $this->articleEntity->listArticles();
    }
}