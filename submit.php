<?php

/**
 * ************************************************************************** *
 * Page: submit.php
 * Author: Rohit Chopra <rohit.chopra@lexisnexis.com>
 * Copyright: 2011 Martindale
 * Comments: Simple form Test
 *      1) This is the submit page for the simple form skill test.
 *      2) Accept the POST data from the registration form.
 *      3) Validate POST data. 
 *      4) Make an API call to the APIStorage service (This service stores
 *              the form data into the database)
 *      5) Upon receiving a successful response, NOTE DOWN the insert ID
 *      6) Redirect to a success page
 *      7) Connect to the MySQL database
 *      8) Pull the data for the last inserted ID
 *      9) Display the data on the screen
 * 
 * ************************************************************************** *
 * 
 * API Information
 * API End Point: http://webops.dev.thelawlinks.com/apistorage/calls/insert/
 * API Key: d7892f1eaaade6b67f21ee5a25666750
 * Accepted methods: POST
 * Parameters:
 * - firstName [Required]
 * - lastName [Required]
 * - dateOfBirth [Required]
 * - eMailAddress [Required]
 * - zipCode [Required]
 * - APIKey  [Required]
 * 
 * Response:
 * Returns a JSON Encoded array.
 * - RESPONSE - A short response code (String).
 * - RESPONSE_CODE - Response Code
 * - MESSAGE - Response details
 * - LAST_INSERT_ID - ID of the newly inserted records (if successful)
 */
$APIKey = "d7892f1eaaade6b67f21ee5a25666750"; // NEEDS TO BE PASSED AS A POST PARAMETER WITH NAME - APIKey
$URL = "http://webops.dev.thelawlinks.com/apistorage/calls/insert/";
// $URL = "https://343d1e19-5d35-4e36-b6e0-455e7e4d20c2.mock.pstmn.io/insert";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$dateOfBirth = $_POST['dateOfBirth'];
$eMailAddress = $_POST['eMailAddress'];
$zipCode = $_POST['zipCode'];

if (empty($firstName) || empty($lastName) || empty($dateOfBirth) || empty($eMailAddress) || empty($zipCode)) {
    die('Please fill all the necessary fields');
};

if (!filter_var($eMailAddress, FILTER_VALIDATE_EMAIL)) {
    die('Please enter valid Email');
};

if (!preg_match("/^\d{5}$/", $zipCode)) {
    die('Please enter correct Zip Code');
};

$ch = curl_init();

$postData = array(
    'firstName' => $firstName,
    'lastName' => $lastName,
    'dateOfBirth' => $dateOfBirth,
    'eMailAddress' => $eMailAddress,
    'zipCode' => $zipCode,
    'APIKey' => $APIKey
);

curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if ($response === false) {
    die('Error during cURL execution: ' . curl_error($ch));
}
curl_close($ch);

$responseData = json_decode($response, true);

var_dump($responseData);

if ($responseData === null) {
    die('Error decoding JSON response: ' . json_last_error_msg());
};

if (isset($responseData['RESPONSE_CODE']) && $responseData['RESPONSE_CODE'] == '200') {
    $lastInsertId = $responseData['LAST_INSERT_ID'];
} else {
    if (isset($responseData['MESSAGE'])) {
        die('Error: ' . $responseData['MESSAGE']);
    } else {
        die('Error: Unexpected API response.');
    }
};

header('Location: success.php?id=' . $lastInsertId);
exit();

