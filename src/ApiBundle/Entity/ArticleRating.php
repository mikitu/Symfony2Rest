<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleRating
 *
 * @ORM\Table(name="article_rating")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ArticleRatingRepository")
 */
class ArticleRating extends AbstractEntity
{
    /**
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Answer")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     */
    private $answer;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;

}

