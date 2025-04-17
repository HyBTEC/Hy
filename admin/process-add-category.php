<?php
include "../function.php";

if(isset($_POST['category_name']) && $_POST['category_name']!="")
{
    $name = $_POST['category_name'];
    $checkExistCategoryQuery = "SELECT * FROM `categories` WHERE `name`='$name' limit 1";
    $result = $mysql->query($checkExistCategoryQuery);
     if ($result && $result->num_rows > 0) {
        echo "Category exist!";
        die;
     }
     else
     {
        $insertCategoryQuery = "INSERT INTO `categories`( `name`) 
        VALUES ('$name')";
        $result = $mysql->query($insertCategoryQuery);
            if (!$result) {
               echo "Error while insert category!";
               die;
            }
            else
            {
                header("location: ".getAdminUrl("?action=category&insert_success=1"));
            }
     }
}
else
{
    die('Invalid data!');
}