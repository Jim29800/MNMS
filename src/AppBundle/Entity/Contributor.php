<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contributor
 *
 * @ORM\Table(name="con_contributor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContributorRepository")
 */
class Contributor
{
    /**
     * @var int
     *
     * @ORM\Column(name="con_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="con_name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="con_max_number", type="integer", nullable=true)
     */
    private $maxNumber;

    /**
     * @var bool
     *
     * @ORM\Column(name="con_is_mnms", type="boolean")
     */
    private $isMnms;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Contributor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxNumber
     *
     * @param integer $maxNumber
     *
     * @return Contributor
     */
    public function setMaxNumber($maxNumber)
    {
        $this->maxNumber = $maxNumber;

        return $this;
    }

    /**
     * Get maxNumber
     *
     * @return int
     */
    public function getMaxNumber()
    {
        return $this->maxNumber;
    }

    /**
     * Set isMnms
     *
     * @param boolean $isMnms
     *
     * @return Contributor
     */
    public function setIsMnms($isMnms)
    {
        $this->isMnms = $isMnms;

        return $this;
    }

    /**
     * Get isMnms
     *
     * @return bool
     */
    public function getIsMnms()
    {
        return $this->isMnms;
    }
    public function __toString()
    {
        return $this->getName();
    }
}

