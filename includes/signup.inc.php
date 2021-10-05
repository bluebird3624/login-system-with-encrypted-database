<?php

if(isset($_POST['submit'])){
    require_once('functions.inc.php');
    $name=validate($_POST['uname']);
    $email=validate($_POST['email']);
    $password=validate($_POST['password']);
    $re_password=validate($_POST['re-password']);


    require_once('dbh.inc.php');
    require_once('functions.inc.php');
    

    if(emptyInputSignup($name,$email,$password,$re_password) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if(invalidUserName($name) !== false){
        header("location: ../signup.php?error=invalidusername");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if(passwordMatch($password,$re_password) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }

    
    if(userNameExists($conn,$name,$email) !== false){
        header("location: ../signup.php?error=usernameoremailexists");
        exit();
    }

    


    createUser($conn,$name,$email,$password);

}

else{
    header('location: ../signup.php');
    exit();
}