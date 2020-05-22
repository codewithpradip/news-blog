<?php
require "config.php";
if(isset( $_SESSION["username"])  &&  $_SESSION["username"]!=""){
    
}else{
    header("Location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-2">
                    <a href="post.php"><img class="logo" src="images/newsblog.jpg"></a>
                </div>
                <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-md-offset-9  col-md-5">
                    <a href="#" class="admin-logout ">Hello : <?php echo $_SESSION["username"];?></a>
                    <a href="logout.php" class="admin-logout mx-5">logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>
                        <?php
                        if($_SESSION["user_role"] == 1){
                        ?>
                        <li>
                            <a href="category.php">Category</a>
                        </li>
                        <li>
                            <a href="users.php">Users</a>
                        </li>
                        <li>
                            <a href="settings.php">Settings</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->