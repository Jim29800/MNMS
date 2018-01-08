<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserEve
 *
 * @ORM\Table(name="nue_nn_usr_eve")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserEventRepository")
 */
class UserEvent
{
    /**
     * @var int
     *
     * @ORM\Column(name="nue_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="nue_is_participating", type="boolean")
     */
    private $isParticipating;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="eve_oid", referencedColumnName="eve_oid")
     */
    private $eveOid;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="usr_oid", referencedColumnName="usr_oid")
     */
    private $usrOid;


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
     * Set isParticipating
     *
     * @param boolean $isParticipating
     *
     * @return UserEve
     */
    public function setIsParticipating($isParticipating)
    {
        $this->isParticipating = $isParticipating;

        return $this;
    }

    /**
     * Get isParticipating
     *
     * @return bool
     */
    public function getIsParticipating()
    {
        return $this->isParticipating;
    }

    /**
     * Set eveOid
     *
     * @param integer $eveOid
     *
     * @return UserEve
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
     * Set usrOid
     *
     * @param integer $usrOid
     *
     * @return UserEve
     */
    public function setUsrOid($usrOid)
    {
        $this->usrOid = $usrOid;

        return $this;
    }

    /**
     * Get usrOid
     *
     * @return int
     */
    public function getUsrOid()
    {
        return $this->usrOid;
    }
}

