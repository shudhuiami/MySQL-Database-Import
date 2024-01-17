<?php

$directory = 'db'; // Change this to the actual path of your SQL files

// Get all SQL files in the directory
$sqlFiles = glob($directory . '/*.sql');

// MySQL connection settings
$host = 'localhost';
$username = 'root';
$password = ''; // Change this if you have a password

// Connect to MySQL server
$mysqli = new mysqli($host, $username, $password);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

foreach ($sqlFiles as $sqlFile) {
    // Extract database name from the file name
    $databaseName = pathinfo($sqlFile, PATHINFO_FILENAME);

    // Check if the database exists
    $checkDatabaseQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'";
    $result = $mysqli->query($checkDatabaseQuery);

    if ($result->num_rows === 0) {
        // Create the database if it doesn't exist
        $createDatabaseQuery = "CREATE DATABASE $databaseName";
        if ($mysqli->query($createDatabaseQuery) === TRUE) {
            echo "Database $databaseName created successfully\n";
        } else {
            echo "Error creating database: " . $mysqli->error . "\n";
            continue; // Skip to the next iteration if there's an error
        }
    } else {
        echo "Database $databaseName already exists\n";
    }

    // MySQL connection settings for the specific database
    $dbName = $databaseName;

    // Check if the database already contains tables
    $checkTablesQuery = "SHOW TABLES FROM $dbName";
    $result = $mysqli->query($checkTablesQuery);

    if ($result->num_rows === 0) {
        // Command to import SQL file into MySQL using Laragon's MySQL
        $importCommand = "mysql -h$host -u$username -p$password $dbName < $sqlFile";
        exec($importCommand);

        // Output the result
        echo "Imported $databaseName\n";
    } else {
        echo "Database $databaseName already contains tables, skipping import\n";
    }
}

// Close the MySQL connection
$mysqli->close();

?>
