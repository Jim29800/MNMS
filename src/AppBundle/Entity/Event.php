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
     * @var string
     *
     * @ORM\Column(name="eve_title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="roo_oid", referencedColumnName="roo_oid")
     */
    private $rooOid;
    /**
     * @ORM\ManyToOne(targetEntity="Workshop")
     * @ORM\JoinColumn(name="wor_oid", referencedColumnName="wor_oid")
     */
    private $worOid;
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
     * Set title
     *
     * @param string $title
     *
     * @return Workshop
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set worOid
     *
     * @param integer $worOid
     *
     * @return Event
     */
    public function setWorOid($worOid)
    {
        $this->worOid = $worOid;

        return $this;
    }

    /**
     * Get worOid
     *
     * @return int
     */
    public function getWorOid()
    {
        return $this->worOid;
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
    public function __toString()
    {
        return $this->getTitle();
    }
}

