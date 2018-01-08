<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workshop
 *
 * @ORM\Table(name="wor_workshop")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkshopRepository")
 */
class Workshop
{
    /**
     * @var int
     *
     * @ORM\Column(name="wor_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="wor_title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="wor_problem", type="string", length=255)
     */
    private $problem;

    /**
     * @var string
     *
     * @ORM\Column(name="wor_goal", type="string", length=255)
     */
    private $goal;

    /**
     * @var bool
     *
     * @ORM\Column(name="wor_is_public", type="boolean")
     */
    private $isPublic;

    /**
     * @var bool
     *
     * @ORM\Column(name="wor_is_archived", type="boolean")
     */
    private $isArchived;

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
     * Set problem
     *
     * @param string $problem
     *
     * @return Workshop
     */
    public function setProblem($problem)
    {
        $this->problem = $problem;

        return $this;
    }

    /**
     * Get problem
     *
     * @return string
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * Set goal
     *
     * @param string $goal
     *
     * @return Workshop
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return string
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return Workshop
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return bool
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set usrOid
     *
     * @param integer $usrOid
     *
     * @return Workshop
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

