<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 08/04/2016
 * Time: 05:24
 */

namespace ApiBundle\DQL;


trait ExtendDoctrine
{
    /**
     * Get random entities
     *
     * @param int $count Entities count, default is 10
     *
     * @return array
     */
    public function getRandomEntities($count = 10)
    {
        return  $this->createQueryBuilder('q')
            ->addSelect('RAND() as HIDDEN rand')
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }
}