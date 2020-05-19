<?php 
require "header.php";
require "config.php";

if( isset($_POST['save']) ){
        $category =mysqli_real_escape_string($con, $_POST['cat']);
        $sql = "SELECT category_name FROM category where category_name='$category'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result)> 0) {
            $regmsg = '<div class="alert alert-warning mt-2" role="alert">Category already exists.</div>';
        }else{
            $sql = "INSERT INTO category (category_name) VALUES ('{$category}')";
            if (mysqli_query($con, $sql)){
                header("location:category.php");
                die();
            }else{
              $regmsg = '<div class="alert alert-warning mt-2" role="alert">Query Failed.</div>';
            }
        }
    }
 ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                    <?php if(isset($regmsg)) {echo $regmsg;} ?>
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php
require "footer.php";
?>