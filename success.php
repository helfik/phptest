<?php

/**
 * Page: success.php
 */


$dbHost = '10.197.211.37';
$dbUser = 'application';
$dbPass = 'NewUser93@!';
$dbDatabase = 'rc_test';
$dbTable = 'tbl_users';

// $dbHost = 'localhost:8000';
// $dbUser = 'root';
// $dbPass = 'Password1324.';
// $dbDatabase = 'my_database';
// $dbTable = 'users';

/**
 * Connect to the database (information above) and retrieve the 
 * row from the tbl_users relation using an ID as a parameter
 * Table Schema:
 * Name             Type            Length          Index
 * id               int             11              PRIMARY
 * firstName        varchar         255
 * lastName         varchar         255
 * dateOfBirth      date            0
 * eMailAddress     varchar         255
 * zipCode          int             5
 * CREATED_AT       datetime        0
 * UPDATED_AT       datetime        0
 */

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    $query = "SELECT * FROM your_table WHERE id = $id";
    $result = $mysqli->query($query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
        echo "<table>";
        echo "<tr><td>First Name</td><td>" . $userData['firstName'] . "</td></tr>";
        echo "<tr><td>Last Name</td><td>" . $userData['lastName'] . "</td></tr>";
        echo "<tr><td>Date of Birth</td><td>" . $userData['dateOfBirth'] . "</td></tr>";
        echo "<tr><td>Email</td><td>" . $userData['eMailAddress'] . "</td></tr>";
        echo "<tr><td>ZIP Code</td><td>" . $userData['zipCode'] . "</td></tr>";
        echo "</table>";
    } else {
        echo "No record found.";
    }

    $mysqli->close();
}
