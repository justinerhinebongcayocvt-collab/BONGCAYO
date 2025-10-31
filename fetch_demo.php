<?php



include 'dbconfig.php'; 

$sql = "SELECT item_name, price FROM grocery_items WHERE price > 50 ORDER BY price DESC";

try {
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "<h2>Demonstrating PDO::fetch()</h2>";

    
    $counter = 1;
    while ($row = $stmt->fetch()) {
        echo "<h3>Result Row #$counter</h3>";
        
        echo "<pre>";
        print_r($row);
        echo "</pre>";
        $counter++;
    }

} catch (PDOException $e) {
    echo "Error fetching data: " . $e->getMessage();
}


?>