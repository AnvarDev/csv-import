<?php

include_once("reader.php");

class GeoDetails extends CSVReader
{
    private $db;
    private $accessKey;
    private $customers = [];

    public function __construct($file)
    {
        if (file_exists("geonames.json"))
            $this->db = @json_decode(file_get_contents("geonames.json"), TRUE);
        $this->accessKey = getenv("KEY");
        $this->read($file);
    }

    public function customers()
    {
        return !empty($this->customers) ? $this->customers : FALSE;
    }

    protected function line($data = [])
    {
        if (count($data) !== 5) return FALSE;

        $customerId = intval($data[0]);
        if ($customerId <= 0) return FALSE;

        if ($country = $this->getPhoneCountry($data[3])) {
            if (!isset($this->customers[$customerId])) {
                $this->customers[$customerId] = [
                    "same" => [
                        "number" => 0,
                        "duration" => 0
                    ],
                    "all" => [
                        "number" => 0,
                        "duration" => 0
                    ]
                ];
            }

            $ipDetails = $this->getIpDetails($data[4]);

            if (!empty($ipDetails["continent_code"]) && $ipDetails["continent_code"] === $country["continent"]) {
                $this->customers[$customerId]["same"]["number"]++;
                $this->customers[$customerId]["same"]["duration"] += intval($data[2]);
            }

            $this->customers[$customerId]["all"]["number"]++;
            $this->customers[$customerId]["all"]["duration"] += intval($data[2]);
        }
    }

    protected function getPhoneCountry($phone)
    {
        foreach ($this->db as $country) {
            if (
                !empty($country["continent"]) && !empty($country["phone"]) &&
                substr($phone, 0, strlen($country["phone"])) == $country["phone"]
            ) {
                return $country;
            }
        }
        return FALSE;
    }

    protected function getIpDetails($ip)
    {
        return @json_decode(@file_get_contents("http://api.ipstack.com/{$ip}?access_key={$this->accessKey}"), TRUE);
    }
}
