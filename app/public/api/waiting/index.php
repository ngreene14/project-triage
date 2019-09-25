<?php

// Step 1: Get a datase connection from our help class
//Dbconnection class tells php to do the autoload function built in composer
//-> is for instance methods; :: is for static classes; always return the same connection
//db object has new instance of PDO object to interact with database
//
$db = DbConnection::getConnection();

// Step 2: Create & run the query
//prepares SQL statement to be executed and returns statement object
$stmt = $db->prepare(
  'SELECT *
  FROM Patient p, PatientVisit pv
  WHERE p.patientGuid = pv.patientGuid'
);
//actually execute the PDO prepare statement object; runs query, gets results and ready to give to me
$stmt->execute();
//procure all of the results; always give an array
$patients = $stmt->fetchAll();

// patientGuid VARCHAR(64) PRIMARY KEY,
// firstName VARCHAR(64),
// lastName VARCHAR(64),
// dob DATE DEFAULT NULL,
// sexAtBirth CHAR(1) DEFAULT ''

// Step 3: Convert to JSON
//give serialized json representation of the variable (turn back into php -->json_decode)
//$json is a string variable
$json = json_encode($patients, JSON_PRETTY_PRINT);

// Step 4: Output
//what the webpage is expecting to get --> browser is expecting json
header('Content-Type: application/json');
//print the returned json variable in the webpage
echo $json;
