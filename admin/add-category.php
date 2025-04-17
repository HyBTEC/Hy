<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add new Order</h1>
    
</div>
<hr>
<form action="<?php echo getAdminUrl("process-add-category.php")?>" 
    method="POST">

    <div class="form-group">
        <label for="">
            Order Name:
        </label>
        <input type="text" required class="form-control" 
        name="category_name">
    </div>
    <button type="submit" class="btn btn-primary">
        Add new Order
    </button>
</form>