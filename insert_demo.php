<?php


include 'dbconfig.php';


$item_name = 'Cereal Box';
$category_id = 4; 
$price = 199.50;
$stock = 60;
$unit = 'pack';


$sql = "INSERT INTO grocery_items (item_name, category_id, price, stock_quantity, unit_of_measure)
        VALUES (:name, :category, :price, :stock, :unit)";

try {
    
    $stmt = $pdo->prepare($sql);

    
    $stmt->bindParam(':name', $item_name);
    $stmt->bindParam(':category', $category_id);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':unit', $unit);

    
    $stmt->execute();

    echo "<h2>Record Insertion Successful!</h2>";
    echo "New item '{$item_name}' was added to the database.";

} catch (PDOException $e) {
    
    echo "Error inserting record: " . $e->getMessage();
}
?>