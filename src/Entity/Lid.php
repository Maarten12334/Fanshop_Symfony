<?php

namespace App\Entity;

use App\Repository\LidRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LidRepository::class)]
class Lid
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Geboortedatum = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $Lidnummer = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $Keuze = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeboortedatum(): ?\DateTimeInterface
    {
        return $this->Geboortedatum;
    }

    public function setGeboortedatum(\DateTimeInterface $Geboortedatum): self
    {
        $this->Geboortedatum = $Geboortedatum;

        return $this;
    }

    public function getLidnummer(): ?int
    {
        return $this->Lidnummer;
    }

    public function setLidnummer(int $Lidnummer): self
    {
        $this->Lidnummer = $Lidnummer;

        return $this;
    }

    public function getKeuze(): ?int
    {
        return $this->Keuze;
    }

    public function setKeuze(int $Keuze): self
    {
        $this->Keuze = $Keuze;

        return $this;
    }
}
