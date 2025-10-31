<?php
// update_demo.php - Demonstrates Updating of Record

include 'dbconfig.php';

// New values for the update
$new_price = 105.00;
$item_id_to_update = 2; // ID of 'Whole Milk'

// SQL statement with placeholders for SET and WHERE clauses
$sql = "UPDATE grocery_items SET price = :price_new WHERE item_id = :id";

try {
    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the values
    $stmt->bindParam(':price_new', $new_price);
    $stmt->bindParam(':id', $item_id_to_update, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Check how many rows were affected
    $updated_rows = $stmt->rowCount();

    echo "<h2>Record Update Successful!</h2>";
    echo "{$updated_rows} record(s) updated. Item ID {$item_id_to_update} now has a price of {$new_price}.";

} catch (PDOException $e) {
    echo "Error updating record: " . $e->getMessage();
}
?>