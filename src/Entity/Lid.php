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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $geboortedatum = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $lidnummer = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $keuze = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeboortedatum(): ?\DateTimeInterface
    {
        return $this->geboortedatum;
    }

    public function setGeboortedatum(\DateTimeInterface $geboortedatum): static
    {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    public function getLidnummer(): ?string
    {
        return $this->lidnummer;
    }

    public function setLidnummer(string $lidnummer): static
    {
        $this->lidnummer = $lidnummer;

        return $this;
    }

    public function getKeuze(): ?string
    {
        return $this->keuze;
    }

    public function setKeuze(?string $keuze): static
    {
        $this->keuze = $keuze;

        return $this;
    }
}
