<?php
include "../function.php";

if (isset($_GET['id']) && $_GET['id'] != '') {
    // check đã có trong db hay chưa dựa trên id.
    // Nếu có: chạy sql xoá, chuyển hướng về trang category.
    // Nếu ko: die
    $id = $_GET['id'];
    $checkExistCategoryQuery = "SELECT * FROM `categories` WHERE `id`='$id'";
    $result = $mysql->query($checkExistCategoryQuery);
    if ($result && $result->num_rows > 0) {
        $deleteCategoryQuery = "DELETE FROM `categories` WHERE `id`='$id'";
        $result = $mysql->query($deleteCategoryQuery);
        if ($result) {
            header("location: " . getAdminUrl("?action=category&delete_success=1"));
        }
        else
            die("Can not delete");
    } else
        die("Not Found");
} else
    die("Invalid data");