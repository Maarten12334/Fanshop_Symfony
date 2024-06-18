<?php

namespace App\Service;

class CsvParser
{
    public function parse(string $filePath): array
    {
        $rows = [];

        if (($handle = fopen($filePath, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $rows[] = array_combine($header, $data);
            }

            fclose($handle);
        }

        return $rows;
    }
}
