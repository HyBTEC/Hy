<?php
// Include necessary files and configurations

// Fetch products from the database along with category names
$getProductsQuery = "SELECT p.*, c.name AS category_name FROM `products` p 
                     INNER JOIN `categories` c ON p.category_id = c.id";
$productResult = $mysql->query($getProductsQuery);
?>

<!-- HTML code to display products list -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
    <a href="<?php echo getAdminUrl("?action=add-product") ?>" class="btn btn-primary">
        Add Product
    </a>
</div>

<div class="row">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Short Description</th>
                <th>Description</th>
                <th>Image</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($productResult && $productResult->num_rows > 0) {
                $i = 1;
                while ($row = $productResult->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['short_description']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><img src="<?php echo $row['image']; ?>" alt="Product Image" style="max-width: 100px;"></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td>
                            <!-- Edit and Delete buttons -->
                            <a href="<?php echo getAdminUrl("?action=update-product&id=" . $row['id']); ?>" class="btn btn-success">Edit</a>
                            <a href="<?php echo getAdminUrl("delete-product.php?id=" . $row['id']); ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php }
            } else {
                ?>
                <tr>
                    <td colspan="8">No products found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
