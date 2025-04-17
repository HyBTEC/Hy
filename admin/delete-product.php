<?php
// Include necessary files and configurations
include "../function.php";

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Sanitize product ID
    $productId = intval($productId);

    // Prepare and execute SQL query to delete the product
    $deleteProductSql = "DELETE FROM `products` WHERE `id`='$productId'";
    $deleteResult = $mysql->query($deleteProductSql);

    // Check if the deletion was successful
    if($deleteResult) {
        // Redirect to the products page with a success message
        header("location: " . getAdminUrl("?action=products&delete_success=1"));
        exit();
    } else {
        // Handle errors, such as database connection issues or SQL errors
        die('Unable to delete product');
    }
} else {
    // Redirect to an error page if product ID is not provided
    header("Location: error.php");
    exit();
}
?>
