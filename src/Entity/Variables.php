<?php

namespace App\Entity;

use App\Repository\VariablesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VariablesRepository::class)
 */
class Variables
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
    private $switch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $epaisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $trydefou;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSwitch(): ?string
    {
        return $this->switch;
    }

    public function setSwitch(string $switch): self
    {
        $this->switch = $switch;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getEpaisseur(): ?string
    {
        return $this->epaisseur;
    }

    public function setEpaisseur(string $epaisseur): self
    {
        $this->epaisseur = $epaisseur;

        return $this;
    }

    public function getTrydefou(): ?string
    {
        return $this->trydefou;
    }

    public function setTrydefou(string $trydefou): self
    {
        $this->trydefou = $trydefou;

        return $this;
    }
}
