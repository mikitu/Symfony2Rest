<?php
/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 07/04/2016
 * Time: 11:51
 */

namespace ApiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Gedmo\Mapping\Annotation as Gedmo;

class AbstractEntity
{
    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function __construct()
    {
        $this->setCreated(new DateTime());
        $this->setUpdated(new DateTime());
    }

    private function setCreated(DateTime $date)
    {
        $this->created = $date;
    }
    private function setUpdated(DateTime $date)
    {
        $this->updated = $date;
    }

}