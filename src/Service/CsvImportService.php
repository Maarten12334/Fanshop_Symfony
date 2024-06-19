<?php

namespace App\Service;

use App\Entity\Lid;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LidRepository;

class CsvImportService
{
    private EntityManagerInterface $entityManager;
    private CsvParser $csvParser;
    private LidRepository $lidRepository;

    public function __construct(EntityManagerInterface $entityManager, CsvParser $csvParser, LidRepository $lidRepository)
    {
        $this->entityManager = $entityManager;
        $this->csvParser = $csvParser;
        $this->lidRepository = $lidRepository;
    }

    public function import(string $filePath): void
    {
        $rows = $this->csvParser->parse($filePath);

        foreach ($rows as $row) {
            // Check for existing Lid with the same geboortedatum and lidnummer
            $existingLid = $this->lidRepository->findOneBy([
                'geboortedatum' => new \DateTime($row['geboortedatum']),
                'lidnummer' => $row['lidnummer']
            ]);

            if (!$existingLid) {
                $lid = new Lid();
                $lid->setGeboortedatum(new \DateTime($row['geboortedatum']));
                $lid->setLidnummer($row['lidnummer']);

                $this->entityManager->persist($lid);
            } // Skip duplicates
        }

        $this->entityManager->flush();
    }
}
