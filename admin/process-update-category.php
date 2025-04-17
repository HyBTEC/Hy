<?php
// Include necessary files and configurations
include "../function.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    $categoryName = $_POST['category_name'];
    $categoryId = $_POST['id'];

    // Sanitize input data
    $categoryName = htmlspecialchars($categoryName);
    $categoryId = intval($categoryId); // Convert to integer to prevent SQL injection

    // Check if the new category name is different from the current one
    $checkUniqueSql = "SELECT COUNT(*) AS count FROM `category` WHERE `name`='$categoryName'
     AND `id` != '$categoryId'";
    $checkResult = $mysql->query($checkUniqueSql);
    $row = $checkResult->fetch_assoc();
    if ($row['count'] > 0) {
        die('Category name already exists');
    }

    // Perform database update
    $updateCategorySql = "UPDATE `categories` SET `name`='$categoryName' WHERE `id`='$categoryId'";
    $updateResult = $mysql->query($updateCategorySql);

    // Check if the update was successful
    if ($updateResult) {
        // Redirect to a success page or display a success message
        header("location: " . getAdminUrl("?action=category&update_success=1"));
        exit();
    } else {
        // Handle errors, such as database connection issues or SQL errors
        die('Unable to update category');
    }
} else {
    // Redirect or display an error message if the form was not submitted
    header("Location: error.php");
    exit();
}
?>
