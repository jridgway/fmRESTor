<?php

// Get record with all optional parameters
use fmRESTor\fmRESTor;
session_start();
require_once dirname(__DIR__) . '/src/fmRESTor.php';

$fm = new fmRESTor("127.0.0.1", "fmRESTor", "php_user", "api", "api123456",array("allowInsecure" => true));

// Create new record
$newRecord = array(
    "fieldData" => array(
        "surname" => "Load Image Name",
        "email" => "email@email.com",
        "birthday" => "1.1.2001",
        "personal_identification_number" => "99",
        "address" => "Street 24, City"
    )
);

$createRecordResponse = $fm->createRecord($newRecord);

// This is ID the record that was made and this record will be get
$id = $createRecordResponse["response"]["recordId"];

// Upload image to created record
$uploadToContainerResponse = $fm->uploadFileToContainter($id, "photo", 1, __DIR__ . "/24uSoftware.jpg");

// Load record from database
$getRecordResponse = $fm->getRecord($id);

// Path in array where is stored image url generated by FileMaker
$imageURL = $getRecordResponse["response"]["data"][0]["fieldData"]["photo"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Image</title>
</head>
<body>
    <img src="<?= $imageURL ?>">
</body>
</html>