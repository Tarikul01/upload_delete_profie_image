<?php
include_once 'dbh.php';

$first=$_POST['firstname'];
$last=$_POST['lastname'];
$uid=$_POST['username'];
$pwd =$_POST['password'];

$sql = "INSERT INTO  users(first,last,username,password)
VALUES('$first','$last','$uid','$pwd')";
mysqli_query($conn,$sql);

 $sqls="SELECT * FROM users WHERE  username='$uid' AND first='$first'";
 $result= mysqli_query($conn,$sqls);
 if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $userid=$row['id'];
        $sqlimg = "INSERT INTO profileimage(userid,status) VALUES('$userid',1)";
        mysqli_query($conn,$sqlimg);
        header("Location: index.php");
    }
 }
 else{
     echo "There have an error";
 }
