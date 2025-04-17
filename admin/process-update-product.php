<?php
// Include necessary files and configurations
include "../function.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $shortDescription = $_POST['short_description'];
    $description = $_POST['description'];
    $categoryId = $_POST['category_id'];

    // Handle image upload (if provided)
    if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
        // Handle image upload similar to process-add-product.php
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 50000000) { 
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Update product details in the database with the new image path
                $updateProductSql = "UPDATE `products` SET `name` = '$productName', `price` = '$price', `short_description` = '$shortDescription', `description` = '$description', `image` = '$targetFile', `category_id` = '$categoryId' WHERE `id` = $productId";
                $updateResult = $mysql->query($updateProductSql);

                // Check if the update was successful
                if ($updateResult) {
                    // Redirect to a success page or display a success message
                    header("location: " . getAdminUrl("?action=products&update_success=1"));
                    exit();
                } else {
                    // Handle errors, such as database connection issues or SQL errors
                    die('Unable to update product');
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update product details in the database without changing the image path
        $updateProductSql = "UPDATE `products` SET `name` = '$productName', `price` = '$price', `short_description` = '$shortDescription', `description` = '$description', `category_id` = '$categoryId' WHERE `id` = $productId";
        $updateResult = $mysql->query($updateProductSql);

        // Check if the update was successful
        if ($updateResult) {
            // Redirect to a success page or display a success message
            header("location: " . getAdminUrl("?action=products&update_success=1"));
            exit();
        } else {
            // Handle errors, such as database connection issues or SQL errors
            die('Unable to update product');
        }
    }
} else {
    // Form not submitted, redirect to an error page
    header("location: " . getAdminUrl("?action=products&update_error=1"));
    exit();
}
?>
