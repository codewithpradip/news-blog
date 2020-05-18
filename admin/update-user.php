<?php
require "config.php";
require "header.php";
$first_name="";
$last_name="";
$username="";
$role="";
if(isset($_GET['id']) && $_GET['id']!=''){
$id = $_GET['id'];
$sql = "select * from user where user_id = '$id'";
    $res = mysqli_query($con,$sql) or die("failed");
    $check=mysqli_num_rows($res);
    if($check > 0){
        $row=mysqli_fetch_assoc($res);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $username = $row['username'];
        $role = $row['role'];
    }else{
        header('location:users.php');
        die();
    }
}else{
        header('location:users.php');
        die();
    }


if(isset($_POST['submit'])){
    $fname = mysqli_real_escape_string($con,$_POST['f_name']);
    $lname = mysqli_real_escape_string($con,$_POST['l_name']);
    $user = mysqli_real_escape_string($con,$_POST['username']);
    // $password = mysqli_real_escape_string($con,md5($_POST['password']));
    $role = mysqli_real_escape_string($con,$_POST['role']);
  
    $res=mysqli_query($con,"select * from user where username='$user'");
    $check=mysqli_num_rows($res);
    if($check > 0){
            $getdata =mysqli_fetch_assoc($res);
            if($id==$getdata['user_id']){

            }else{               
                $regmsg = '<div class="alert alert-warning mt-2" role="alert">User Name Already Registered</div>';
            }
         
    }
    if($regmsg==""){
        $sql = "update user set first_name='$fname',last_name='$lname',username='$user',role='$role' where user_id='$id'";
        if(mysqli_query($con,$sql)){
        header('location:users.php');
        die();
        }
                           
        
    }
                    
} 

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $first_name ?>"
                            placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $last_name ?>"
                            placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username ?>"
                            placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" value="<?php echo $role ?>">
                            <?php 
                            if($role == 1){
                                echo "<option value='0'>normal User</option>
                                       <option value='1' selected>Admin</opti on>";
                            }else{
                                echo "<option value='0'selected>normal User</option>
                                      <option value='1'>Admin</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <?php if(isset($regmsg)) {echo $regmsg;} ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>