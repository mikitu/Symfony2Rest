<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 08/04/2016
 * Time: 05:37
 */

namespace ApiBundle\Utils;
use Faker\Factory as Faker;

trait FakerTrait
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

}