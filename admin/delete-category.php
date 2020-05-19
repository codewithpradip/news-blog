<?php 
require "config.php";
if(isset($_GET['id']) && $_GET['id']!=''){
    $cat_id = $_GET['id'];
    $sql = "select * from category where category_id = '$cat_id'";
    $result = mysqli_query($con,$sql);
    $check = mysqli_num_rows($result);
    if($check > 0){
        $sqld = "delete from category where category_id='$cat_id'";
        if(mysqli_query($con,$sqld)){
            header('location:category.php');
            die(); 
        }else{
           $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Con\'t Delete Category Record </div>';
        }
    }else{
        header('location:category.php');
        die();
    }
}else{
    header('location:category.php');
    die();
}
?>