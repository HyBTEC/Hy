<?php
// Include necessary files and configurations

// Fetch categories from the database
$getCategoriesQuery = "SELECT * FROM `categories` ORDER BY `name` ASC";
$categoryResult = $mysql->query($getCategoriesQuery);
?>

<!-- HTML form to add a new product with image upload and category selection -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
</div>

<form action="<?php echo getAdminUrl("process-add-product.php") ?>" method="POST" 
enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" class="form-control" id="product_name" name="product_name" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="short_description">Short Description:</label>
        <textarea class="form-control" id="short_description" name="short_description" required></textarea>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <div class="form-group">
        <label for="category_id">Category:</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <option value="">Select Category</option>
            <?php
            // Loop through categories to populate the dropdown
            if ($categoryResult && $categoryResult->num_rows > 0) {
                while ($row = $categoryResult->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
