<?php

require_once 'components/config.php';

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['nume'];
    $surname = $_POST['prenume'];
    $email = $_POST['email'];
    $phone_number = $_POST['nr_telefon'];
    $quantity = $_POST['produs'];
    $county = $_POST['judet'];
    $town = $_POST['oras'];
    $adress = $_POST['adresa'];

// Prepare and bind
    $stmt = $conn->prepare("INSERT INTO data (nume, prenume ,email, nr_telefon, produs, judet, oras, adresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiisss", $name, $surname, $email, $phone_number, $quantity, $county, $town, $adress);

// Execute the statement
    if ($stmt->execute()) {
        echo "Comanda a fost efectuată cu succes.";
    } else {
        echo "Error: " . $stmt->error;
    }

// Close connection
    $stmt->close();
    $conn->close();

    }

?>