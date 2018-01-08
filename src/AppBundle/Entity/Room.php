<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="roo_room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
{
    /**
     * @var int
     *
     * @ORM\Column(name="roo_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="roo_name", type="string", length=255, nullable=true)
     */
    private $Name;

    /**
     * @var string
     *
     * @ORM\Column(name="roo_address", type="string", length=255, nullable=true)
     */
    private $Address;

    /**
     * @var string
     *
     * @ORM\Column(name="roo_city", type="string", length=255, nullable=true)
     */
    private $City;

    /**
     * @var string
     *
     * @ORM\Column(name="roo_zipcode", type="string", length=255, nullable=true)
     */
    private $Zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="roo_country", type="string", length=255, nullable=true)
     */
    private $Country;

    /**
     * @var int
     *
     * @ORM\Column(name="roo_area", type="integer", nullable=true)
     */
    private $Area;

    /**
     * @var int
     *
     * @ORM\Column(name="roo_max_people", type="integer", nullable=true)
     */
    private $MaxPeople;

    /**
     * @var bool
     *
     * @ORM\Column(name="roo_islet", type="boolean", nullable=true)
     */
    private $Islet;

    /**
     * @var bool
     *
     * @ORM\Column(name="roo_projection", type="boolean", nullable=true)
     */
    private $Projection;

    /**
     * @var bool
     *
     * @ORM\Column(name="roo_exit", type="boolean", nullable=true)
     */
    private $Exit;

    /**
     * @var bool
     *
     * @ORM\Column(name="roo_wall", type="boolean", nullable=true)
     */
    private $Wall;

    /**
     * @var bool
     *
     * @ORM\Column(name="roo_paperboard", type="boolean", nullable=true)
     */
    private $Paperboard;

    /**
     * @var bool
     *
     * @ORM\Column(name="roo_need_place", type="boolean", nullable=false)
     */
    private $NeedPlace;

    /**
     * @var int
     *
     * @ORM\Column(name="roo_place_number_people", type="integer", nullable=true)
     */
    private $PlaceNumberPeople;

    /**
     * @var int
     *
     * @ORM\Column(name="roo_place_number_islet", type="integer", nullable=true)
     */
    private $PlaceNumberIslet;

    /**
     * @var int
     *
     * @ORM\Column(name="roo_place_area", type="integer", nullable=true)
     */
    private $PlaceArea;


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
     * Set Name
     *
     * @param string $Name
     *
     * @return Room
     */
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set Address
     *
     * @param string $Address
     *
     * @return Room
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * Get Address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * Set City
     *
     * @param string $City
     *
     * @return Room
     */
    public function setCity($City)
    {
        $this->City = $City;

        return $this;
    }

    /**
     * Get City
     *
     * @return string
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * Set Zipcode
     *
     * @param string $Zipcode
     *
     * @return Room
     */
    public function setZipcode($Zipcode)
    {
        $this->Zipcode = $Zipcode;

        return $this;
    }

    /**
     * Get Zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->Zipcode;
    }

    /**
     * Set Country
     *
     * @param string $Country
     *
     * @return Room
     */
    public function setCountry($Country)
    {
        $this->Country = $Country;

        return $this;
    }

    /**
     * Get Country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * Set Area
     *
     * @param integer $Area
     *
     * @return Room
     */
    public function setArea($Area)
    {
        $this->Area = $Area;

        return $this;
    }

    /**
     * Get Area
     *
     * @return int
     */
    public function getArea()
    {
        return $this->Area;
    }

    /**
     * Set MaxPeople
     *
     * @param integer $MaxPeople
     *
     * @return Room
     */
    public function setMaxPeople($MaxPeople)
    {
        $this->MaxPeople = $MaxPeople;

        return $this;
    }

    /**
     * Get MaxPeople
     *
     * @return int
     */
    public function getMaxPeople()
    {
        return $this->MaxPeople;
    }

    /**
     * Set Islet
     *
     * @param boolean $Islet
     *
     * @return Room
     */
    public function setIslet($Islet)
    {
        $this->Islet = $Islet;

        return $this;
    }

    /**
     * Get Islet
     *
     * @return bool
     */
    public function getIslet()
    {
        return $this->Islet;
    }

    /**
     * Set Projection
     *
     * @param boolean $Projection
     *
     * @return Room
     */
    public function setProjection($Projection)
    {
        $this->Projection = $Projection;

        return $this;
    }

    /**
     * Get Projection
     *
     * @return bool
     */
    public function getProjection()
    {
        return $this->Projection;
    }

    /**
     * Set Exit
     *
     * @param boolean $Exit
     *
     * @return Room
     */
    public function setExit($Exit)
    {
        $this->Exit = $Exit;

        return $this;
    }

    /**
     * Get Exit
     *
     * @return bool
     */
    public function getExit()
    {
        return $this->Exit;
    }

    /**
     * Set Wall
     *
     * @param boolean $Wall
     *
     * @return Room
     */
    public function setWall($Wall)
    {
        $this->Wall = $Wall;

        return $this;
    }

    /**
     * Get Wall
     *
     * @return bool
     */
    public function getWall()
    {
        return $this->Wall;
    }

    /**
     * Set Paperboard
     *
     * @param boolean $Paperboard
     *
     * @return Room
     */
    public function setPaperboard($Paperboard)
    {
        $this->Paperboard = $Paperboard;

        return $this;
    }

    /**
     * Get Paperboard
     *
     * @return bool
     */
    public function getPaperboard()
    {
        return $this->Paperboard;
    }

    /**
     * Set NeedPlace
     *
     * @param boolean $NeedPlace
     *
     * @return Room
     */
    public function setNeedPlace($NeedPlace)
    {
        $this->NeedPlace = $NeedPlace;

        return $this;
    }

    /**
     * Get NeedPlace
     *
     * @return bool
     */
    public function getNeedPlace()
    {
        return $this->NeedPlace;
    }

    /**
     * Set PlaceNumberPeople
     *
     * @param integer $PlaceNumberPeople
     *
     * @return Room
     */
    public function setPlaceNumberPeople($PlaceNumberPeople)
    {
        $this->PlaceNumberPeople = $PlaceNumberPeople;

        return $this;
    }

    /**
     * Get PlaceNumberPeople
     *
     * @return int
     */
    public function getPlaceNumberPeople()
    {
        return $this->PlaceNumberPeople;
    }

    /**
     * Set PlaceNumberIslet
     *
     * @param integer $PlaceNumberIslet
     *
     * @return Room
     */
    public function setPlaceNumberIslet($PlaceNumberIslet)
    {
        $this->PlaceNumberIslet = $PlaceNumberIslet;

        return $this;
    }

    /**
     * Get PlaceNumberIslet
     *
     * @return int
     */
    public function getPlaceNumberIslet()
    {
        return $this->PlaceNumberIslet;
    }

    /**
     * Set PlaceArea
     *
     * @param integer $PlaceArea
     *
     * @return Room
     */
    public function setPlaceArea($PlaceArea)
    {
        $this->PlaceArea = $PlaceArea;

        return $this;
    }

    /**
     * Get PlaceArea
     *
     * @return int
     */
    public function getPlaceArea()
    {
        return $this->PlaceArea;
    }
}

