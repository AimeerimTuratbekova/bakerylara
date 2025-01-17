<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "conn.php";

// Get user inputs and sanitize them
$email = trim($_POST['email']);
$password = $_POST['password'];

function insertUser($conn, $email, $password) {
    $stmt = $conn->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    if (!$stmt->bind_param("ss", $email, $password)) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute the statement
    if (!$stmt->execute()) {
        die("Error inserting user: " . $stmt->error);
    }

    echo "User inserted successfully. Redirecting...";
    $stmt->close();
    header("Refresh: 2; url=index.html");
    exit();
}


insertUser($conn, $email, $password);
$conn->close();

?>
