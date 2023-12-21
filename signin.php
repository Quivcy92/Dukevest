<?php
  require_once("core/common.php");
  
  if(isset($_POST['submit'])){

      $email = escape($_POST['email']);
      $password = escape($_POST['password']);

      $userDetails = [
          'email' => $email,
          'password' => md5($password)//encrypted password
      ];

      $user =  $dbManager->fetchSingleData('user', $userDetails);
      if($user){
        setUserSession($user);
        $accountType = $user['accountType'];
        if($accountType == 'CLIENT'){
          header("Location: client.php");
        }else if($accountType == 'ADMIN'){
          header("Location: admin.php");
        }else if($accountType == 'RM'){
          header("Location: rm.php");
        }
      } else {
        header("Location: signin.php?error=1");
      }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Sign-In</title>
  </head>
  <body>
    <section class="sign-in-page">
      <div class="si-thumbnail">
        <?php
          require_once("core/common.php");

          if(isset($_GET["error"])){
            $error = $_GET["error"];
            switch ($error) {
                case "1":
                    echo "Invalid Username and Password";
                    break;
                case "2":
                    echo "You need to sign in before you can access this page";
                    break;
            };
          }
          
        ?>
      </div>
      <div>
        <div class="si-container">
          <div class="si-thumbnail">
            <img src="./Images/Dukevest-SUP.png" alt="" />
          </div>
          <h2>Sign into your Dukevest Account</h2>
          <form action="" method="POST">
            <div class="si-details">
              <label for="email">Email:</label>
              <input id="email" name = "email" type="email" required />
            </div>
            <div class="si-details">
              <label for="password">Password:</label>
              <input id="password" name = "password" type="password" required />
            </div>
            <hr />
            <!-- Submit Button for the Sign Up Form -->
            <input class="si-btn" name = "submit" type="submit" value="Sign In" />
          </form>
        </div>
        <div class="si-footer">
          <a href="sign-up.html"><span>Create Account</span></a>
          <a href="index.php"><span>Home</span></a>
          <a href="#"><span>Terms</span></a>
        </div>
      </div>
    </section>
  </body>
</html>
