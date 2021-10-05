<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Title</title>
    <link rel='stylesheet' href='login.css'>
</head>
<body>

<div class="login-container">
  <section class="login" id="login">
    <header>
      <h2>Website Title</h2>
      <h4>Sign Up</h4>
    </header>
    <form class="login-form" action='includes/signup.inc.php' method="post">
      <input name='uname' type="text" class="login-input" placeholder="User Name" required autofocus/>
      <input name='email' type="email" class="login-input" placeholder="E-mail" required autofocus/>
      <input name='password' type="password" class="login-input" placeholder="Password" required/>
      <input name='re-password' type="password" class="login-input" placeholder="Confirm Password" required/>
      <div class="submit-container">
        <button name='submit' type="submit" class="login-button">SIGN UP</button>
      </div>
      <div>
      <?php
if(isset($_GET['error'])){
    if($_GET['error']=='passwordsdontmatch'){
        echo"<p style=color:red;> Please make sure your passwords match</p>";
    }
}
if(isset($_GET['error'])){
  if($_GET['error']=='usernameoremailexists'){
      echo"<p style=color:red;>UserName or Email is already used</p>";
  }
}
?>
      </div>
    </form>

  </section>
  <p><a href="login.php" style='color:green;'>Already Have an Account</a></p>

</div>
<div></div>
</body>
</html>