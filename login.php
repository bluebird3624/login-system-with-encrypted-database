<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='login.css'>
    <title>Website Title</title>
</head>
<body>
    


<div class="login-container">
  <section class="login" id="login">
    <header>
      <h2>Website Title</h2>
      <h4>Login</h4>
    </header>
    <form class="login-form" action="includes/login.inc.php" method="post">
      <input name='uname' type="text" class="login-input" placeholder="User Name/Email  " required autofocus/>
      <input name='password' type="password" class="login-input" placeholder="Password" required/>
      <div class="submit-container">
        <button name="submit" type="submit" class="login-button">LOG IN</button>
      </div>
      <div>
      <?php
      if(isset($_GET['error'])){
        if($_GET['error']=='passwordsdontmatch'){
        echo"<p style=color:red;> Please make sure your passwords match</p>";
        }
      }
      ?>
      </div>
    </form>
  </section>
  <p><a href="signup.php" style='color:green;'>Sign Up</a></p>
</div>
<button id="e1">Forgot password</button>
</body>
</html>