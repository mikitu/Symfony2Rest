<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 07/04/2016
 * Time: 06:46
 */

namespace ApiLib\Tests\Fixtures;


use ApiLib\Interfaces\ArticleRepositoryInterface;

class Article implements ArticleRepositoryInterface
{
    public function listArticles()
    {
        return [
            [
                'id' => 12,
                'title' => 'kljkl jkl lkj lk',
                'excerpt' => 'jlk jslk jflksj dlkfajsdk jflasdkjf sdj',
                'body' => 'jlk jslk jflksj dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf sdj',
                'no_answers' => 10,
                'rating' => 4.3,
            ],
            [
                'id' => 13,
                'title' => 'tyurtyurtyurty r lk',
                'excerpt' => 'jlk jslk jflksj dlkfajsdk jflasdkjf sdj',
                'body' => 'jlk jslk jflksj dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf sdj',
                'no_answers' => 0,
                'rating' => 4.3,
            ],
            [
                'id' => 123,
                'title' => 'aaaaa a a atyurtyurtyurty r lk',
                'excerpt' => 'jlk jslk jflksj dlkfajsdk jflasdkjf sdj',
                'body' => 'jlk jslk jflksj dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf sdj',
                'no_answers' => 0,
                'rating' => 3.2,
            ],
            [
                'id' => 124,
                'title' => 'eeeee  a atyurtyurtyurty r lk',
                'excerpt' => 'jlk jslk jflksj dlkfajsdk jflasdkjf sdj',
                'body' => 'jlk jslk jflksj dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf sdj',
                'no_answers' => 0,
                'rating' => 3.2,
            ],
        ];
    }
    public function get($article_id)
    {
        return
            [
                'id' => 12,
                'title' => 'kljkl jkl lkj lk',
                'excerpt' => 'jlk jslk jflksj dlkfajsdk jflasdkjf sdj',
                'body' => 'jlk jslk jflksj dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf sdj',
                'no_answers' => 10,
                'rating' => 4.8,
            ]
        ;

    }
    public function getAnswers($article_id)
    {
        return
             [
                [
                    'id' => 1,
                    'body' => 'jlk jslk jflksj dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf sdj',
                    'author' => 'Jijel',
                    'hr_date' => 'February 23, 2016',
                ],
                [
                    'id' => 1,
                    'body' => 'jlk jslk jflksj dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf dlkfajsdk jflasdkjf sdj',
                    'author' => 'Gicu',
                    'hr_date' => 'February 24, 2016',
                ],
            ];

    }

    public function saveAnswer(array $data)
    {
        return true;
    }
}