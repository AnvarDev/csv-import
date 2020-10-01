<?php

if (
    !isset($_FILES["file"]) ||
    (isset($_FILES["file"]) && ($_FILES["file"]["error"] > 0 || $_FILES["file"]["type"] !== "text/csv"))
) {
    if (isset($_FILES["file"])) {
        $messages = [$_FILES["file"]["error"] > 0 ?
            "Error code: " . $_FILES["file"]["error"] :
            "Invalid file type: {$_FILES["file"]["type"]}"];
    } else $messages = ["No file selected"];
    include_once("index.php");
    die();
}

include_once("geo.php");

$geoDetails = new GeoDetails($_FILES["file"]);
$customers = $geoDetails->customers();
if (!$customers) $messages = ["Something went wrong"];

include_once("index.php");
