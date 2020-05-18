<?php 
require "config.php";
if(isset($_GET['id']) && $_GET['id']!=''){
    $id = $_GET['id'];
    $sql = "select * from user where user_id = '$id'";
    $res = mysqli_query($con,$sql);
    $check = mysqli_num_rows($res);
    if($check > 0){
        $sqld = "delete from user where user_id='$id'";
        if(mysqli_query($con,$sqld)){
            header('location:users.php');
            die(); 
        }else{
           $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Con\'t Delete User Record </div>';
        }
    }else{
        header('location:users.php');
        die();
    }
}else{
    header('location:users.php');
    die();
}
?>