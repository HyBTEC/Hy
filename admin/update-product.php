<?php
// Include necessary files and configurations

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details from the database based on the provided product ID
    $getProductQuery = "SELECT * FROM `products` WHERE `id` = $productId";
    $productResult = $mysql->query($getProductQuery);

    // Check if product exists
    if($productResult && $productResult->num_rows > 0) {
        $product = $productResult->fetch_assoc();
?>
        <!-- HTML form to update product details -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Product</h1>
        </div>

        <form action="<?php echo getAdminUrl("process-update-product.php") ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="short_description">Short Description:</label>
                <textarea class="form-control" id="short_description" name="short_description" required><?php echo $product['short_description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    // Loop through categories to populate the dropdown
                    $getCategoriesQuery = "SELECT * FROM `categories` ORDER BY `name` ASC";
                    $categoryResult = $mysql->query($getCategoriesQuery);
                    if ($categoryResult && $categoryResult->num_rows > 0) {
                        while ($row = $categoryResult->fetch_assoc()) {
                            $selected = ($product['category_id'] == $row['id']) ? 'selected' : '';
                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
<?php
    } else {
        // Product not found, redirect to an error page
        header("location: " . getAdminUrl("?action=products&update_error=1"));
        exit();
    }
} else {
    // Product ID not provided, redirect to an error page
    header("location: " . getAdminUrl("?action=products&update_error=1"));
    exit();
}
?>
