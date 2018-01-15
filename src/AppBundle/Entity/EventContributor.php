<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventContributor
 *
 * @ORM\Table(name="nec_nn_eve_con")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventContributorRepository")
 */
class EventContributor
{
    /**
     * @var int
     *
     * @ORM\Column(name="nec_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="eve_oid", referencedColumnName="eve_oid")
     */
    private $eveOid;


    /**
     * @ORM\ManyToOne(targetEntity="Contributor")
     * @ORM\JoinColumn(name="con_oid", referencedColumnName="con_oid")
     */
    private $conOid;

    /**
     * @var int
     *
     * @ORM\Column(name="nec_needed_number", type="integer")
     */
    private $neededNumber;


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
     * Set eveOid
     *
     * @param integer $eveOid
     *
     * @return EventContributor
     */
    public function setEveOid($eveOid)
    {
        $this->eveOid = $eveOid;

        return $this;
    }

    /**
     * Get eveOid
     *
     * @return int
     */
    public function getEveOid()
    {
        return $this->eveOid;
    }

    /**
     * Set conOid
     *
     * @param integer $conOid
     *
     * @return EventContributor
     */
    public function setConOid($conOid)
    {
        $this->conOid = $conOid;

        return $this;
    }

    /**
     * Get conOid
     *
     * @return int
     */
    public function getConOid()
    {
        return $this->conOid;
    }

    /**
     * Set neededNumber
     *
     * @param integer $neededNumber
     *
     * @return EventContributor
     */
    public function setNeededNumber($neededNumber)
    {
        $this->neededNumber = $neededNumber;

        return $this;
    }

    /**
     * Get neededNumber
     *
     * @return int
     */
    public function getNeededNumber()
    {
        return $this->neededNumber;
    }
    
    public function __toString()
    {
        return $this->getConOid();
    }
}

