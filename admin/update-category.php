<?php
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $getCategorySql = "SELECT * FROM `categories` WHERE `id`='$id' ";
    $result = $mysql->query($getCategorySql);
    if($result && $result->num_rows>0)
    {
        $category = $result->fetch_assoc();
    }
    else
        die('Unable to get category');
}
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Category "<?php echo $category['name']?>"</h1>
</div>
<hr>
<form action="<?php echo getAdminUrl("process-update-category.php")?>" 
    method="POST">

    <div class="form-group">
        <label for="">
            Category Name:
        </label>
        <input type="text" required class="form-control" value="<?php echo $category['name']?>"
        name="category_name">
    </div>
    <input type="hidden" name="id" value=<?php echo $category['id']?> >
    <button type="submit" class="btn btn-primary">
        Update Category
    </button>
</form>