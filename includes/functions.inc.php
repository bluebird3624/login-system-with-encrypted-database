<?php


function emptyInputSignup($name,$email,$password,$re_password){
    $result;
    if(empty($name) || empty($email) ||empty($password) ||empty($re_password)){
        $result=true;  
    }
    else{
        $result=false;
    }
    return $result;
}

function invalidUserName($name){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
        $result=true;  
    }
    else{
        $result=false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $result=true;  
    }
    else{
        $result=false;
    }
    return $result;
}

function passwordMatch($password,$re_password){
    $result;
    if($password !== $re_password){
        $result=true;  
    }
    else{
        $result=false;
    }
    return $result;
}

function userNameExists($conn,$name,$email){
    $sql="SELECT * FROM users WHERE user_name = ? OR email = ?;";
    $stmt= mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed1");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$name,$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function createUser($conn,$name,$email,$password){
    $sql="INSERT INTO users (user_name,password,email) values (?,?,?);";
    $stmt= mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPassword= password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"sss",$name,$hashedPassword,$email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../successful.php");
    exit();
}

function validate($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function emptyInputLogin($name,$password){
    $result;
    if(empty($name)||empty($password)){
        $result=true;  
    }
    else{
        $result=false;
    }
    return $result;
}

function loginUser($conn,$name,$password){

    $sql="SELECT * FROM users WHERE user_name = '$name' OR email = '$name';";    
    $res=mysqli_query($conn,$sql);

    if($res=== null){
        header("location: ../signup.php?error=$res");
    }
    else{
        $row = mysqli_fetch_assoc($res);
        $passwordhashed=$row['password'];
        $chakepass=password_verify($password,$passwordhashed);
    
        if($chakepass===false){
            header("location: ../login.php?error=wronglogin");
            exit();
        }
        elseif($chakepass===true){
            session_start();
            $_SESSION['username']=$usernameExists['user_name'];
            $_SESSION['profile']=$usernameExists['pimage'];
    
            header("location: ../index.php");
            exit();
        }
    }

}


function protect($string){
    $string=mysql_real_escape_string(trim(strip_tags(addslashes($string))));
    return $string;
}

//encrypt
$key=md5('chezakamawewe');
function encrypt($string,$key){
    $string=rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB)));
    return $string;
}


//decrypt
function decrypt($string,$key){
    $string=rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string),MCRYPT_MODE_ECB));
    return $string;
}