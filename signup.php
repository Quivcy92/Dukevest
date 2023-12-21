<?php
  require_once("core/common.php");

  if(isset($_POST['submit'])){
      $firstName = escape($_POST['first_name']);
      $lastName = escape($_POST['last_name']);
      $email = escape($_POST['email']);
      $phoneNumber = escape($_POST['phone_number']);
      $address = escape($_POST['address']);
      $password = escape($_POST['password']);
      $confirmPassword = escape($_POST['confirm_password']);
      $accountType = 'CLIENT';

      if ($password !== $confirmPassword) {
        echo "password does not match"; 
        exit;
      }

      if( $dbManager->checkIfUserExists($email)){
        echo "email address already exists";
      } else {
        $values = [
            'firstName' 		=> $firstName,
            'lastName' 			=> $lastName,
            'email' 			  => $email,
            'phoneNumber' 	=> $phoneNumber,
            'address' 			=> $address,
            'password' 			=> md5($password),
            'accountType'   => $accountType
        ];

        if ( $dbManager->newData('user', $values)){
          setUserSession($values);
          header("Location: client.php");
        }else{
          echo "error";
        }
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
    <title>Sign-Up</title>
  </head>
  <body>
    <nav class="navbar">
      <div class="navContainer">
        <div class="logo">
          <a href="index.php">
            <img src="./Images/Dukevest-logos.jpeg" alt="Dukevest Logo" />
          </a>
        </div>
        <ul class="navLeft">
          <li>
            <a href="index.php">Home</a>
          </li>
          <li>
            <a href="about-us.html">About Us</a>
          </li>
          <li>
            <a href="contact-us.html">Contact Us</a>
          </li>
        </ul>
        <ul class="navRight">
          <li>
            <a href="#">
              <img src="./Images/location.gif" alt="locate a branch" />
              <span class="adj">Find a Branch</span>
            </a>
          </li>
          <li>
            <a href="signin.php"><button class="btn">Sign In</button></a>
          </li>
          <div class="searchBox">
            <input
              type="text"
              class="searchText"
              placeholder="search keywords..."
            />
            <a href="#" class="searchBtn">
              <i class="fa-solid fa-magnifying-glass-dollar fa-2x"></i>
            </a>
          </div>
        </ul>
      </div>
    </nav>
    <section class="sign-up-page">
      <div class="su-container">
        <div class="su-form">
          <div class="su-thumbnail">
            <img src="./Images/Dukevest-SUP.png" alt="" />
          </div>
          <h2>Few details to get you onboard</h2>
          <form action="" method="POST">
            <div class="su-details">
              <label for="first_name">First Name:</label>
              <div class="su-input">
                <input id="first_name" type="text" name="first_name" required />
              </div>
            </div>
            <div class="su-details">
              <label for="last_name">Last Name:</label>
              <div class="su-input">
                <input id="last_name" type="text" name="last_name" required />
              </div>
            </div>
            <div class="su-details">
              <label for="email">Email:</label>
              <div class="su-input">
                <input id="email" type="email" name="email" required />
              </div>
            </div>
            <div class="su-details">
              <label for="phone_number">Phone Number:</label>
              <div class="su-input">
                <input
                  id="phone_number"
                  type="text"
                  name="phone_number"
                  required
                />
              </div>
            </div>
            <div class="su-details">
              <label for="address">Address:</label>
              <div class="su-input">
                <input id="address" type="text" name="address" required />
              </div>
            </div>
            <div class="su-details">
              <label for="password"> Password:</label>
              <div class="su-input">
                <input id="password" type="password" name="password" required />
              </div>
            </div>
            <div class="su-details">
              <label for="confirm_password">Confirm Password:</label>
              <div class="su-input">
                <input
                  id="confirm_password"
                  type="password"
                  name="confirm_password"
                  required
                />
              </div>
            </div>
            <hr />
            <!-- Submit Button for the Sign Up Form -->
            <input value="Sign Up" name = "submit" type="submit" class="su-btn" />
          </form>
        </div>
      </div>
    </section>
  </body>
</html>
