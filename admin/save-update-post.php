<?php
require "config.php";

if(empty($_FILES['new-image']['name'])){
  $file_name = $_POST['old-image'];
}else{
  $errors = array();

  $file_name = $_FILES['new-image']['name'];
  $file_size = $_FILES['new-image']['size'];
  $file_tmp = $_FILES['new-image']['tmp_name'];
  $file_type = $_FILES['new-image']['type'];
  $dt = explode('.',$file_name);
  $file_ext = end($dt);

  $extensions = array("jpeg","jpg","png");

  if(in_array($file_ext,$extensions) === false)
  {
    $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
  }

  if($file_size > 2097152)
  {
    $errors[] = "File size must be 2mb or lower.";
  }


//   $new_name = time(). "-".basename($file_name);
//   $target = "upload/".$new_name;
//   $image_name = $new_name;
  
  if(empty($errors) == true){
    move_uploaded_file($file_tmp,"upload/".$file_name);
  }else{
    print_r($errors);
    die();
  }
}

$sql = "UPDATE post SET title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category={$_POST["category"]},post_img='{$file_name}' WHERE post_id={$_POST["post_id"]};";

// if($_POST['old_category'] != $_POST["category"] ){
//   $sql .= "UPDATE category SET post= post - 1 WHERE category_id = {$_POST['old_category']};";
//   $sql .= "UPDATE category SET post= post + 1 WHERE category_id = {$_POST["category"]};";
// }

// $result = mysqli_multi_query($con,$sql);
$result = mysqli_query($con,$sql);
if($result){
  header("location:post.php");
}else{
  echo "Query Failed";
}

?>