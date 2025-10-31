<?php
 

include 'dbconfig.php';

 
 
$item_id_to_delete = 7;

 
$sql = "DELETE FROM grocery_items WHERE item_id = :id";

try {
     
    $stmt = $pdo->prepare($sql);

     
    $stmt->bindParam(':id', $item_id_to_delete, PDO::PARAM_INT);

     
    $stmt->execute();

     
    $deleted_rows = $stmt->rowCount();

    echo "<h2>Record Deletion Successful!</h2>";
    echo "{$deleted_rows} record(s) with ID {$item_id_to_delete} were deleted.";

} catch (PDOException $e) {
    echo "Error deleting record: " . $e->getMessage();
}
?>