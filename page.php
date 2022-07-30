<?php
require "./dbhelper.php";

session_start();

function loggedIn() {
    if (isset($_SESSION['username'])) {
        return true;
    }
    
    $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    if (!$cookie) {
        return false;
    }
    list ($email, $token, $mac) = explode(':', $cookie);
    if (!hash_equals(hash_hmac('sha256', $email . ':' . $token, "lMRxf3xggCa2Lxtb"), $mac)) {
        return false;
    }
    $usertoken = getToken($email);
    if (hash_equals($usertoken, $token)) {
        $_SESSION['username'] = $email;
        return true;
    }
}

loggedIn();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Quattrocento&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="page.css">
    <link rel="stylesheet" href="buttons.css">
    <link rel="stylesheet" href="style.css">

    <!-- jQuery Library-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>

    <!-- Javascript -->
    <script type="text/javascript" src="group.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://kit.fontawesome.com/38ae3d5d5b.js" crossorigin="anonymous"></script><!-- Font Awesome icon -->
</head>


    <body>
        <!-- Top Navigation Bar -->
        <header class="topnav">

        <!-- Main Logo -->
        <a href="index.php">
            <div class="logo nav-left">
                    <img class="vd-logo" src="./res/vegidrone_logo.png" alt="vegidrone logo">
            </div>
        </a>

        <!-- Deliver To -->
        <!-- <div class="delivery nav-left">
            <p id="location-txt">deliver to</p>
        </div> -->

        <!-- Search Bar -->
        <form name="search" class="search nav-left">
            <input class="search-bar" type="search">
            <button type="submit" class="search-ico"></button>
        </form>

        <!-- Login Button -->
        <?php
            $uname = "Sign In / Register";
            $onclick = " onclick='showLogin();'";
            if (isset($_SESSION['username'])) {
                $uname = $_SESSION['username'];
                $onclick = "";
            }
            echo "<div class='login-nav-btn' $onclick>\n
                    <p class='welcome-txt'>Welcome</p>\n
                    <b class='sign-in-txt'>$uname</b>\n
                    </div>";
        ?>

        <!-- Login Window -->
        <div id="login-window" class="login">
            <span class="login-close" title="Close" onclick="closeLogin();">
                &times;
            </span>
            <div class="login-content">
                <form class="login-container" action="login.php" method="post">
                        <label for="username"><b>Email</b></label>
                        <input id="un-input" name="email" class="login-txt" type="text" placeholder="Enter Email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required><br>
                        <label for="password"><b>Password</b></label>
                        <input id="pw-input" name="pw" class="login-txt" placeholder="Enter Password" type="password" required><br>
                        <button class="login-btn" type="submit">Login</button><br>
                </form>
                <a href="./register/index.html"><button class="register-btn" value="register">Register</button></a>
            </div>
        </div>


        <!-- Cart Icon -->
        <div class="cart nav-right">
            <img class="cart-ico" class src="./res/cart_ico_white.png" alt="cart icon">
            <p class="cart-text">Cart</p>
        </div>

        </header>

        <!-- Bottom Navigation Bar -->
        <div class="botnav">

        <!-- Browse Btn -->
        <a class="botnav-btn" href="#">
            <span >Browse</span>
        </a>

        <!-- About Btn -->
        <a class="botnav-btn" href="./about/index.html">
            <span >About</span>
        </a>

        <!-- Contact Btn -->
        <a class="botnav-btn" href="#">
            <span>Contact</span>
        </a>
    </div>
    
    
    <!-- Main Container -->
    <div class="main">
        <section class="product-page">
            <h1 class="product-name">Strawberries</h1>  
            <div class="about-product">
                  <p class="product-amount">1 pint</p>
                  <h2 class="product-price">$2.99</h2>
                  <p class="product-description">A modest description. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod, ad praesentium est aspernatur voluptate eos laudantium non architecto consequatur soluta rerum possimus voluptatem odit eligendi tempore quam autem libero iusto.</p>
              </div>
              <img class="product-img" src="//unsplash.it/500/500">
              <div class="adjust-product">
                  <div class="adjust-quantity">
                      <p class="quantity">Quantity: <button class="sub-quantity custom-btn blue-grad">-</button>
                          <span class="quantity-count">1</span>
                          <button class="add-quantity custom-btn orange-grad">+</button>
                      </p>
                  </div>
                <div class="add-product">
                  <button class="add-cart custom-btn purple-grad">Add to cart</button>
                </div>
              </div>
          </section>
          
          <!--Future section for comments-->
          <!-- <section class="comments"></section> -->
      
          <footer>
              <p class="copyright">Copyright &copy; VegiDrone 2022 - All Rights Reserved</p>
              <nav>
                  <ul class="secondary-nav">
                      <li><a href="#">About Us</a></li>
                      <li><a href="#">Privacy Policy</a></li>
                      <li><a href="#">Terms and Conditions</a></li>
                      <li><a href="#">Returns Policy</a></li>
                  </ul>
              </nav>
          </footer>
    </div>

</body>
</html>
