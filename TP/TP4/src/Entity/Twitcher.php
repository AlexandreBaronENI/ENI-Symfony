<?php

namespace App\Entity;

use App\Repository\TwitcherRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TwitcherRepository::class)
 */
class Twitcher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $certified;

    /**
     * @ORM\Column(type="date")
     */
    private $dateInscription;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCertified()
    {
        return $this->certified;
    }

    /**
     * @param mixed $certified
     */
    public function setCertified($certified): void
    {
        $this->certified = $certified;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription($dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }
}
