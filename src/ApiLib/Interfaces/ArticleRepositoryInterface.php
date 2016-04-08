<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 07/04/2016
 * Time: 06:49
 */

namespace ApiLib\Interfaces;

interface ArticleRepositoryInterface
{
    public function listArticles();
    public function get($article_id);
    public function getAnswers($article_id);
    public function saveAnswer(array $data);
    public function saveArticle(array $data);
}