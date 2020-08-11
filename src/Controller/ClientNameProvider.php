<?php

require __DIR__ . '/../Model/GoogleSheetsClient.php';

Class ClientNameProvider
{
    public function __toString()
    {
        $client = new GoogleSheetsClient();
        $values = $client->getSheetValues('1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms', 'Class Data', 'A1:B10');
        $names = "";
        foreach ($values as $row)
        {
            // Print columns A and E, which correspond to indices 0 and 4.
            $names = $names . $row[0] . ', ' . $row[1] . "\n";
        }

        return $names;
    }
}
