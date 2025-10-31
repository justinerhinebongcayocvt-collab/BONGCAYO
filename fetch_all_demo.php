<?php


 
include 'dbconfig.php'; 


$sql = "SELECT item_name, price, stock_quantity FROM grocery_items LIMIT 5";

try {
    
    $stmt = $pdo->prepare($sql);

    
    $stmt->execute();

   
    $results = $stmt->fetchAll();

    
    echo "<h2>Demonstrating PDO::fetchAll()</h2>";
    echo "<pre>";
    print_r($results);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Error fetching data: " . $e->getMessage();
}


?>