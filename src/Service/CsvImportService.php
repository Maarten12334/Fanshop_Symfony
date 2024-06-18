<?php

namespace App\Service;

use App\Entity\Lid;
use Doctrine\ORM\EntityManagerInterface;

class CsvImportService
{
    private EntityManagerInterface $entityManager;
    private CsvParser $csvParser;

    public function __construct(EntityManagerInterface $entityManager, CsvParser $csvParser)
    {
        $this->entityManager = $entityManager;
        $this->csvParser = $csvParser;
    }

    public function import(string $filePath): void
    {
        $rows = $this->csvParser->parse($filePath);

        foreach ($rows as $row) {
            $lid = new Lid();
            $lid->setGeboortedatum(new \DateTime($row['geboortedatum']));
            $lid->setLidnummer($row['lidnummer']);
            $lid->setKeuze($row['keuze'] ?: null);

            $this->entityManager->persist($lid);
        }

        $this->entityManager->flush();
    }
}
