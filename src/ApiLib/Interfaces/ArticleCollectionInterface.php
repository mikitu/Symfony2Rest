<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 07/04/2016
 * Time: 07:00
 */

namespace ApiLib\Interfaces;


interface ArticleCollectionInterface
{
    public function setPage($page);
    public function setLimit($limit);
    public function all();
}