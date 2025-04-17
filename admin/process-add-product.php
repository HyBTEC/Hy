<?php
// Include necessary files and configurations
include "../function.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $shortDescription = $_POST['short_description'];
    $description = $_POST['description'];
    $categoryId = $_POST['category_id'];

    // Sanitize input data (if needed)
    

    // Handle image upload (similar to your previous code)
    // Example:
    $targetDir = "uploads";
    $targetFile = '../'.$targetDir.'/' . basename($_FILES["image"]["name"]);
    //  -> luu file o '../uploads/tenfileuplen.jpg'
    $filename =  $targetDir.'/'. basename($_FILES["image"]["name"]);
    //  -> luu tenfile trong database: 'uploads/tenfileuplen.jpg


    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // // Check if file already exists
    // if (file_exists($targetFile)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size
    // tính theo đơn vị byte. tức là 500 ngàn byte hay 500kb
    if ($_FILES["image"]["size"] > 500000) { 
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
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert product into the database if image upload is successful
    if ($uploadOk == 1) {
        // Insert product into the database
        $insertProductSql = "INSERT INTO `products` (`name`, `price`, `short_description`, `description`, `image`, `category_id`) 
                             VALUES ('$productName', '$price', '$shortDescription', '$description', '$filename', '$categoryId')";
        $insertResult = $mysql->query($insertProductSql);

        // Check if the insertion was successful
        if ($insertResult) {
            // Redirect to a success page or display a success message
            header("location: " . getAdminUrl("?action=products&add_success=1"));
            exit();
        } else {
            // Handle errors, such as database connection issues or SQL errors
            die('Unable to add product');
        }
    }
}
?>
