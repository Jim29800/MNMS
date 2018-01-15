<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * User
 *
 * @ORM\Table(name="usr_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="usr_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_lastname", type="string", length=255)
     */
    private $lastname;

// ================================================================================== 

    /**
     * @var string
     *
     * @ORM\Column(name="usr_avatar", type="string", length=255)
     */
    private $avatar;

    /**
     * @Vich\UploadableField(mapping="user_avatars", fileNameProperty="avatar")
     * @var File
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

// ==================================================================================

    /**
     * @var string
     *
     * @ORM\Column(name="usr_function", type="string", length=255, nullable=true)
     */
    private $function;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="usr_leader_oid", referencedColumnName="usr_oid")
     */
    private $leaderOid;


    public function __construct()
    {
        parent::__construct();
    }




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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set function
     *
     * @param string $function
     *
     * @return User
     */
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set leaderOid
     *
     * @param integer $leaderOid
     *
     * @return User
     */
    public function setLeaderOid($leaderOid)
    {
        $this->leaderOid = $leaderOid;

        return $this;
    }

    /**
     * Get leaderOid
     *
     * @return int
     */
    public function getLeaderOid()
    {
        return $this->leaderOid;
    }

// ==================================================================================
    public function setAvatarFile(File $avatar = null)
    {
        $this->avatarFile = $avatar;

        if ($avatar) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

}

