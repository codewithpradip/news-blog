<?php
require "header.php";
if($_SESSION["user_role"] == 0){
        header("Location:post.php");
        die();
    }
$first_name="";

if(isset($_GET['id']) && $_GET['id']!=''){
$cat_id = $_GET['id'];
$sql = "SELECT * FROM category WHERE category_id ='$cat_id'";
    $result = mysqli_query($con, $sql) or die("failed");
    $check=mysqli_num_rows($result);
    if($check > 0){
        $row=mysqli_fetch_assoc($result);
        $category_name = $row['category_name'];
    }else{
        header('location:category.php');
        die();
    }
}else{
        header('location:category.php');
        die();
}
if(isset($_POST['submit'])){

    $cat_name = mysqli_real_escape_string($con,$_POST['cat_name']);

    $result=mysqli_query($con,"select * from category where category_name='$cat_name'");
    $check=mysqli_num_rows($result);
    if($check > 0){
        $getdata =mysqli_fetch_assoc($result);
        if($cat_id==$getdata['category_id']){

        }else{
        $regmsg = '<div class="alert alert-warning mt-2" role="alert">Category Already Registered</div>';
        }

    }
    if($regmsg==""){
        $sql1 = "UPDATE category SET  category_name='$cat_name'  WHERE  category_id='$cat_id'";
        if(mysqli_query($con,$sql1)){
        header('location:category.php');
        die();
        }
    }

}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading">Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label>category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="<?php echo $category_name; ?>"
                            placeholder="" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    <?php if(isset($regmsg)) {echo $regmsg;} ?>
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>