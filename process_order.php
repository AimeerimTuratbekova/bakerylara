<?php

include "conn.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
$card = isset($_POST['card']) ? trim($_POST['card']) : '';
$date = isset($_POST['date']) ? trim($_POST['date']) : '';
$time = isset($_POST['time']) ? trim($_POST['time']) : '';

// Validate required fields
if (empty($name) || empty($surname) || empty($card) || empty($date) || empty($time)) {
    die("All fields are required.");
}

function insertOrder($conn, $name, $surname, $card, $date, $time) {
    $stmt = $conn->prepare("INSERT INTO orders (name, surname, card, order_date, order_time) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    if (!$stmt->bind_param("sssss", $name, $surname, $card, $date, $time)) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute the statement
    if (!$stmt->execute()) {
        die("Error inserting order: " . $stmt->error);
    }

    $stmt->close();

    // Display confirmation message
    echo "<h1>Order Confirmation</h1>";
    echo "<p>Thank you, <strong>$name $surname</strong>, for your order!</p>";
    echo "<p>Order Date: $date</p>";
    echo "<p>Order Time: $time</p>";
    echo "<p>Payment will be processed using card ending in " . substr($card, -4) . ".</p>";

    // Redirect after 2 seconds
    header("Refresh: 5; url=index.html");
    exit(); // Ensure no further code executes
}

// Call the function
insertOrder($conn, $name, $surname, $card, $date, $time);

// Close the database connection
$conn->close();
