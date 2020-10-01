<?php

class CSVReader
{
    public function read($file = [])
    {
        $handle = isset($file["tmp_name"]) ? @fopen($file["tmp_name"], "r") : FALSE;
        if ($handle !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $this->line($data);
            }
            return fclose($handle);
        }
        return FALSE;
    }

    protected function line($data = [])
    {
    }
}
