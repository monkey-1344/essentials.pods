<?php
// Simulated price calculation function (you can replace this with your actual logic)
function calculatePrice($quantity) {
    // Example calculation: price = quantity * 10
    return $quantity * 330;
}

// Check if quantity is set and is numeric
if (isset($_POST['quantity']) && is_numeric($_POST['quantity'])) {
    $quantity = intval($_POST['quantity']); // Get quantity as integer
    $price = calculatePrice($quantity); // Calculate the price

    echo $price; // Output the calculated price
} else {
    echo 'Cantitate invalidă'; // Error message if quantity is missing or not numeric
}
?>