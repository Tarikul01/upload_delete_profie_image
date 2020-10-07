<?php
session_start();
include_once 'dbh.php';
$id=$_SESSION['id'];

if(isset($_POST['submit'])){
 $file=$_FILES['file'];
$fileName=$_FILES['file']['name'];
$fileTmpName=$_FILES['file']['tmp_name'];
$fileError=$_FILES['file']['error'];
$fileSize=$_FILES['file']['size'];
$fileExt=explode('.',$fileName);
$fileActExt=strtolower(end($fileExt));
$allow=array('jpg','jpeg','png','pdf');

if (in_array($fileActExt,$allow)){
     if($fileError===0){
         if($fileSize<1000000){
             $allowedname="profile".$id.".".$fileActExt;
             $fileDestination='uploads/'.$allowedname;

              move_uploaded_file($fileTmpName,$fileDestination);
              $sql="UPDATE profileimage SET status=0 WHERE userid='$id';";
              $result=mysqli_query($conn,$sql);
             header("Location: index.php?uploadedsucessfull");
         }
         else{
             echo "This file size is  so big";
         }
     }
     else{
         echo "There was an error in  your uploading file";

     }
}
else{
    echo "This file is not exctual extention";
}
}

?>