<?php
session_start();

if(isset($_POST['submitLogin'])){
    echo "session";
    $_SESSION['id'] =  1;

    header("Location: index.php?loginSucessfull"); 
}