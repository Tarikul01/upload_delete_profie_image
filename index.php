<?php 
 session_start();
 include_once 'dbh.php';

?>



<!DOCTYPE html>
<html>
<head>
	<title>profile img </title>
	<style>
	.img{
		background-color: lightblue;
		width:200px;
		text-align:center;
		border: 1px solid red;
	}
	.img img{
		width:150px;
		height:100px;
		margin:10px;
		border-radius:5px;
	   text-align:center;
	}
	.img p{
		margin-top:-19px;
	}
	</style>
</head>
<body>
<?php 

	$sql="SELECT * FROM users";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			$idimg=$row['id'];
			$sqlimg="SELECT * FROM profileimage WHERE userid='$idimg'";
			$resultimg=mysqli_query($conn,$sqlimg);

			while($rowimg=mysqli_fetch_assoc($resultimg)){
				     echo "<div class='img'>";

                 if($rowimg['status']==0){
					$filename="uploads/profile".$idimg."*";
					$fileinfo=glob($filename);
					$fileext=explode(".",$fileinfo[0]);
					$fileactualext=$fileext[1];
					 echo "<img src='uploads/profile".$idimg.".".$fileactualext."?".mt_rand()."'>";
				 }
				 else{
					 echo "<img src='uploads/person.jpg'>";
				 }
				 echo $row['username'];
				 echo"</div>";
			}
		}
	}
	else{
		echo "There was no user yet!!<br>";
	}





     if(isset($_SESSION['id'])){
		 if($_SESSION['id'] == 1){
			 echo "You are loged in!";
		 }
		 echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>
		 <input type='file' name='file'>
		 <button  type='submit' name='submit'>UPLOAD</button>
	 </form>";
	 echo "<form action='delet.php' method='POST' >
	 
	 <button  type='submit' name='submitDelet'>Delete profile</button>
 </form>";
	 } 
	 else{
		 echo "You are logout !";
		 echo " <form action='signup.php' method='POST'>
		 <input type='text' name='firstname' placeholder='First Name'><br>
		 <input type='text' name='lastname' placeholder='Last Name'><br>
		 <input type='text' name='username' placeholder='UserName'><br>
		 <input type='password' name='password' placeholder='Password'><br>
		 <button type='submit' name='submitSignup'>Signup</button><br>
		 </form>";
		
	 }
?>



<p>Login here!</p>
<form action="login.php" method="POST">
<button type="submit" name="submitLogin">Login</button>
</form>
<p>Logout here!</p>
<form action="logout.php" method="POST">
<button type="submit" name="submitLogout">Logout</button>
</form>
</body>
</html>