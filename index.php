<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: ../PANEL/");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image" href="../ASSETS/img/logo1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ASSETS/css/style_index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,
100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,
500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Imarket</title>
</head>
<body>
   <!-- LOGIN MODAL -->
    <?php
    // Notification alert for error
    if (isset($_SESSION['error'])) {
        echo '<div class="notification-alert error" id="notificationError">'
            . htmlspecialchars($_SESSION['error']) .
            '<span class="close-alert" onclick="document.getElementById(\'notificationError\').style.display=\'none\'">&times;</span></div>';
        unset($_SESSION['error']);
    }
    ?>
    <style>
        .notification-alert {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 9999;
            min-width: 250px;
            padding: 16px 24px;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(255, 254, 254, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: fadeIn 0.5s;
        }
        .notification-alert.error { background: #dc3545; }
        .close-alert {
            margin-left: 16px;
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            transition: color 0.2s;
        }
        .close-alert:hover {
            color: #00153d;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>
    <script>
        // Auto-hide notification after 5 seconds
        setTimeout(function() {
            var error = document.getElementById('notificationError');
            if (error) error.style.display = 'none';
        }, 5000);
    </script>
    <div class="login-modal" id="loginModal">
    <div class="login-content">
        <span class="close-btn" id="closeLogin">&times;</span>
        <h2>Login</h2>
        <form method="POST" action="CONFIG/login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Enter password" required>
                <i class="ri-eye-line" id="togglePassword"></i>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <!-- Sign up link -->
        <p class="signup-text">
            Don't have an account yet? 
            <a href="#" id="openSignup">Sign up here</a>
        </p>
    </div>
</div>
<!-- SIGNUP MODAL -->
<div class="signup-modal" id="signupModal">
    <div class="signup-content">
        <span class="close-btn" id="closeSignup">&times;</span>
        <h2>Sign Up</h2>
        <form>
            

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter email" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" placeholder="Enter phone number" required>

            <label for="newPassword">Password</label>
            <div class="password-wrapper">
                <input type="password" id="newPassword" placeholder="Enter password" required>
                <i class="ri-eye-line toggleSignupPassword"></i>
            </div>

            <button type="submit" class="login-btn">Create Account</button>
        </form>

        <!-- Divider -->
        <div class="divider">
            <span>OR</span>
        </div>

        <!-- Social login buttons -->
        <div class="social-login">
            <button type="button" class="google-btn">
                <img src="ASSETS/img/google.png" alt="Google Logo">
                Sign up with Google
            </button>
            <button type="button" class="facebook-btn">
                <i class="ri-facebook-fill"></i> Sign up with Facebook
            </button>
        </div>

        <!-- Back to login -->
        <p class="signup-text">
            Already have an account? 
            <a href="#" id="openLoginFromSignup">Login here</a>
        </p>
    </div>
</div>



<header>
  <div class="logo">
    <img src="ASSETS/img/logo.png" alt="IMARKET PH Logo">
  </div>

  <ul class="navbar" id="navbar">
    <li><a href="#" class="active"><i class="ri-home-line"></i> Home</a></li>
    <li><a href="#"><i class="ri-store-line"></i> Mall</a></li>
    <li><a href="#"><i class="ri-percent-line"></i> Flash Deals</a></li>
    
    <li class="dropdown">
        <a href="#"><i class="ri-list-unordered"></i> Categories <i class="ri-arrow-down-s-line"></i></a>
        <ul class="dropdown-menu">
            <li><a href="#"><i class="ri-fire-line"></i> Best Selling</a></li>
            <li><a href="#"><i class="ri-star-smile-line"></i> New Arrivals</a></li>
            <li><a href="#"><i class="ri-computer-line"></i> Electronics</a></li>
            <li><a href="#"><i class="ri-t-shirt-line"></i> Fashion & Apparel</a></li>
            <li><a href="#"><i class="ri-home-4-line"></i> Home & Living</a></li>
            <li><a href="#"><i class="ri-heart-line"></i> Beauty & Health</a></li>
            <li><a href="#"><i class="ri-football-line"></i> Sports & Outdoor</a></li>
            <li><a href="#"><i class="ri-gamepad-line"></i> Toys & Games</a></li>
            <li><a href="#"><i class="ri-shopping-basket-line"></i> Groceries</a></li>
        </ul>
    </li>

    
  </ul>
<!-- Search bar always visible -->
<div class="search-bar">
  <input type="text" placeholder="Search for products, brands and more..." />
  <button class="search-btn"><i class="ri-search-line"></i></button>
</div>
<div class="icons">
  <!-- Removed Search Icon -->
   <a href="#"><i class="ri-shopping-cart-line"></i></a>
  <a href="#"><i class="ri-user-line"></i></a>
  
  <div class="bx bx-menu" id="menu-icon"></div>
</div>

</header>

<!-- Overlay background -->
<div class="overlay" id="overlay"></div>

<section class="hero">
  <div class="hero-slides">
    <img class="slide active" src="ASSETS/img/clothes.webp" alt="Slide 1">
    <img class="slide" src="ASSETS/img/soap.jpg" alt="Slide 2">
    <img class="slide" src="ASSETS/img/pc.webp" alt="Slide 3">
    <img class="slide" src="ASSETS/img/home.jpg" alt="Slide 4">
    <img class="slide" src="ASSETS/img/school.webp" alt="Slide 5">
  </div>

  <div class="hero-content">
    <h1>IMARKET PH</h1>
    <p>Discover amazing deals and best-selling products.</p>
    <a href="#" class="hero-btn">Shop Now</a>
  </div>

  <!-- ✅ Dots Indicator -->
  <div class="hero-dots">
    <span class="dot active" data-index="0"></span>
    <span class="dot" data-index="1"></span>
    <span class="dot" data-index="2"></span>
    <span class="dot" data-index="3"></span>
    <span class="dot" data-index="4"></span>
  </div>
</section>


<section class="feature">
  <div class="middle-text">
    <h2>Discover <span>Quality Products</span></h2>
  </div>
  <div class="feature-content">

  <!-- Product 1 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/sneakers.webp" alt="Men's Sneakers">
      <span class="discount">-35%</span>
    </div>
    <div class="product-info">
      <h6>Men's Sneakers</h6>
      <h3>₱899 <del>₱1,399</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 1,245 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 2 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/headset.jpg" alt="Gaming Headset">
      <span class="discount">-50%</span>
    </div>
    <div class="product-info">
      <h6>Gaming Headset</h6>
      <h3>₱499 <del>₱999</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 980 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 3 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/back.jpg" alt="Casual Backpack">
      <span class="discount">-40%</span>
    </div>
    <div class="product-info">
      <h6>Casual Backpack</h6>
      <h3>₱599 <del>₱999</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 740 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 4 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/relo.jpg" alt="Smart Watch">
      <span class="discount">-60%</span>
    </div>
    <div class="product-info">
      <h6>Smart Watch</h6>
      <h3>₱799 <del>₱1,999</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 1,560 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 5 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/lamp.jpg" alt="LED Desk Lamp">
      <span class="discount">-25%</span>
    </div>
    <div class="product-info">
      <h6>LED Desk Lamp</h6>
      <h3>₱299 <del>₱399</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 430 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 6 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/earbuds.jpg" alt="Wireless Earbuds">
      <span class="discount">-30%</span>
    </div>
    <div class="product-info">
      <h6>Wireless Earbuds</h6>
      <h3>₱699 <del>₱999</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 860 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 7 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/mouse.jpg" alt="Gaming Mouse">
      <span class="discount">-45%</span>
    </div>
    <div class="product-info">
      <h6>Gaming Mouse</h6>
      <h3>₱329 <del>₱599</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 1,120 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 8 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/hoodie.jpg" alt="Hooded Jacket">
      <span class="discount">-35%</span>
    </div>
    <div class="product-info">
      <h6>Hooded Jacket</h6>
      <h3>₱1,299 <del>₱1,999</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 560 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 9 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/keyboard.jpg" alt="Mechanical Keyboard">
      <span class="discount">-55%</span>
    </div>
    <div class="product-info">
      <h6>Mechanical Keyboard</h6>
      <h3>₱1,499 <del>₱3,299</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 2,010 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  <!-- Product 10 -->
  <div class="product-card">
    <div class="product-img">
      <img src="ASSETS/img/water.jpg" alt="Insulated Water Bottle">
      <span class="discount">-20%</span>
    </div>
    <div class="product-info">
      <h6>Insulated Water Bottle</h6>
      <h3>₱399 <del>₱499</del></h3>
      <p class="buyers"><i class="fas fa-user-check"></i> 740 sold</p>
      <div class="actions">
  <a href="#" class="btn buy">Buy Now</a>
  <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
</div>

    </div>
  </div>

  </div>
</section>


      <section class="product">
        <div class="middle-text">
            <h2>New  <span>Arrival</span></h2>
        </div>
         <div class="feature-content">

    <!-- Product 1 -->
    <div class="product-card">
      <div class="product-img">
        <img src="ASSETS/img/airpods.jpg" alt="AirPods Pro 2">
        <span class="discount">NEW</span>
      </div>
      <div class="product-info">
        <h6>Apple</h6>
        <h3>AirPods Pro 2</h3>
        <p class="buyers"><i class="fas fa-bolt"></i> Just Arrived</p>
        <div class="actions">
          <a href="#" class="btn buy">Buy Now</a>
          <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <div class="product-img">
        <img src="ASSETS/img/shoes.jpg" alt="Nike Dunk Low">
        <span class="discount">NEW</span>
      </div>
      <div class="product-info">
        <h6>Nike</h6>
        <h3>Dunk Low Panda</h3>
        <p class="buyers"><i class="fas fa-bolt"></i> Fresh Drop</p>
        <div class="actions">
          <a href="#" class="btn buy">Buy Now</a>
          <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <div class="product-img">
        <img src="ASSETS/img/controller.jpg" alt="PS5 DualSense Edge">
        <span class="discount">NEW</span>
      </div>
      <div class="product-info">
        <h6>Sony</h6>
        <h3>DualSense Edge</h3>
        <p class="buyers"><i class="fas fa-bolt"></i> Latest Release</p>
        <div class="actions">
          <a href="#" class="btn buy">Buy Now</a>
          <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <div class="product-img">
        <img src="ASSETS/img/ultra.jpg" alt="Smart Watch Ultra">
        <span class="discount">NEW</span>
      </div>
      <div class="product-info">
        <h6>Smart Tech</h6>
        <h3>Watch Ultra Gen 2</h3>
        <p class="buyers"><i class="fas fa-bolt"></i> Brand New</p>
        <div class="actions">
          <a href="#" class="btn buy">Buy Now</a>
          <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <div class="product-img">
        <img src="ASSETS/img/jbl.png" alt="JBL Go 4 Speaker">
        <span class="discount">NEW</span>
      </div>
      <div class="product-info">
        <h6>JBL</h6>
        <h3>Go 4 Portable Speaker</h3>
        <p class="buyers"><i class="fas fa-bolt"></i> New Arrival</p>
        <div class="actions">
          <a href="#" class="btn buy">Buy Now</a>
          <a href="#" class="btn cart"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </div>


    
  </div>
</section>

    <!-- FOOTER -->
<footer class="footer">
  <div class="footer-container">
    
    <!-- Customer Care -->
    <div class="footer-section">
      <h5>Customer Care</h5>
      <ul>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">How to Buy</a></li>
        <li><a href="#">Shipping & Delivery</a></li>
        <li><a href="#">Return & Refund</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>

    <!-- About -->
    <div class="footer-section">
      <h5>About ImarketPH</h5>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Terms & Conditions</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>

    <!-- Payment Methods -->
    <div class="footer-section">
      <h5>Payment Methods</h5>
      <div class="footer-logos">
        <img src="ASSETS/img/visa.png" alt="Visa">
        <img src="ASSETS/img/mastercard.png" alt="Mastercard">
        <img src="ASSETS/img/gcash.png" alt="GCash">
        <img src="ASSETS/img/maya.png" alt="Paymaya">
      </div>
    </div>

    <!-- Delivery Services -->
    <div class="footer-section">
      <h5>Delivery Services</h5>
      <div class="footer-logos">
        <img src="ASSETS/img/jnt.png" alt="J&T Express">
        <img src="ASSETS/img/ninjavan.jpg" alt="Ninja Van">
        <img src="ASSETS/img/lbc.png" alt="LBC Express">
        <img src="ASSETS/img/flash.png" alt="Flash Express">
      </div>
    </div>

    <!-- Follow Us -->
    <div class="footer-section">
      <h5>Follow Us</h5>
      <div class="footer-socials">
        <a href="#"><img src="ASSETS/img/facebook.png" alt="Facebook"></a>
        <a href="#"><img src="ASSETS/img/instagram.jpg" alt="Instagram"></a>
        <a href="#"><img src="ASSETS/img/twitter.png" alt="Twitter"></a>
        <a href="#"><img src="ASSETS/img/youtube.png" alt="YouTube"></a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    <p>© 2025 All Rights Reserved by ImarketPH</p>
  </div>
</footer>
      <script src="https://unpkg.com/scrollreveal"></script>
      <script src="ASSETS/js/script.js"></script>
        
</body>
</html>