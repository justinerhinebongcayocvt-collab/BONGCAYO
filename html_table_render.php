<?php


include 'dbconfig.php';


$sql = "SELECT g.item_name, c.category_name, g.price, g.stock_quantity
        FROM grocery_items g
        INNER JOIN categories c ON g.category_id = c.category_id
        ORDER BY g.item_name ASC";

try {
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    
    $results = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grocery Items Report</title>
    <style>
       
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Grocery Inventory Report</h1>

    <table>
        <thead>
            <tr>
                <?php
                
                if (count($results) > 0) {
                   
                    $headers = array_keys($results[0]);
                    foreach ($headers as $header) {
                        
                        echo "<th>" . ucwords(str_replace('_', ' ', $header)) . "</th>";
                    }
                } else {
                    echo "<th>No Records Found</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            
            foreach ($results as $row) {
                echo "<tr>";
                
                foreach ($row as $data) {
                    echo "<td>" . htmlspecialchars($data) . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </body>
</html>