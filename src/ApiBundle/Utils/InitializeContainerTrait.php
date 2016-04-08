<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 08/04/2016
 * Time: 06:19
 */

namespace ApiBundle\Utils;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


trait InitializeContainerTrait
{
    protected $container;
    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


}