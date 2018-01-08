<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="eve_event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="eve_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="roo_oid", referencedColumnName="roo_oid")
     */
    private $rooOid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eve_date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="eve_is_over", type="boolean")
     */
    private $isOver;

    /**
     * @var bool
     *
     * @ORM\Column(name="eve_is_returned", type="boolean")
     */
    private $isReturned;


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
     * Set rooOid
     *
     * @param integer $rooOid
     *
     * @return Event
     */
    public function setRooOid($rooOid)
    {
        $this->rooOid = $rooOid;

        return $this;
    }

    /**
     * Get rooOid
     *
     * @return int
     */
    public function getRooOid()
    {
        return $this->rooOid;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set isOver
     *
     * @param boolean $isOver
     *
     * @return Event
     */
    public function setIsOver($isOver)
    {
        $this->isOver = $isOver;

        return $this;
    }

    /**
     * Get isOver
     *
     * @return bool
     */
    public function getIsOver()
    {
        return $this->isOver;
    }

    /**
     * Set isReturned
     *
     * @param boolean $isReturned
     *
     * @return Event
     */
    public function setIsReturned($isReturned)
    {
        $this->isReturned = $isReturned;

        return $this;
    }

    /**
     * Get isReturned
     *
     * @return bool
     */
    public function getIsReturned()
    {
        return $this->isReturned;
    }
}

