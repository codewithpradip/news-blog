<?php 
require "header.php";
if($_SESSION["user_role"] == 0){
        header("Location:post.php");
        die();
    }

if(isset($_POST['save'])){
    $fname = mysqli_real_escape_string($con,$_POST['fname']);
    $lname = mysqli_real_escape_string($con,$_POST['lname']);
    $user = mysqli_real_escape_string($con,$_POST['user']);
    $password = mysqli_real_escape_string($con,md5($_POST['password']));
    $role = mysqli_real_escape_string($con,$_POST['role']);

    $sql = "select username from user where username='$user'";
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res) > 0){
        $regmsg = '<div class="alert alert-warning mt-2" role="alert">User Name Already Registered</div>';
    }else{
        $sql1 = "insert into user (first_name,last_name,username,password,role) value('$fname','$lname','$user','$password','$role')";
        if(mysqli_query($con,$sql1)){
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
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                    <?php if(isset($regmsg)) {echo $regmsg;} ?>
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>