<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: /PANEL");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ASSETS/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
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
<div class="login-modal" id="loginModal">
    <div class="login-content">
        <span class="close-btn" id="closeLogin">&times;</span>
        <h2>Login</h2>
        <form method="POST" action="CONFIG/login.php">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Enter username" required>

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" id="password" placeholder="Enter password" required>
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

    <li><a href="#"><i class="ri-customer-service-2-line"></i> 5 Star Ratings</a></li>
  </ul>

  <div class="icons">
  <a href="#" id="search-toggle"><i class="ri-search-line"></i></a>
  <a href="#"><i class="ri-user-line"></i></a>
  <a href="#"><i class="ri-shopping-cart-line"></i></a>
  <div class="bx bx-menu" id="menu-icon"></div>
</div>

<!-- hidden search bar -->
<div class="search-bar" id="search-bar">
  <input type="text" placeholder="Search..." />
</div>

</header>



<!-- Overlay background -->
<div class="overlay" id="overlay"></div>

<!-- ✅ Hero Slideshow -->
<section class="hero">
  <div class="hero-slides">
    <img class="slide active" src="ASSETS/img/clothes.webp" alt="Slide 1">
    <img class="slide" src="ASSETS/img/soap.jpg" alt="Slide 2">
    <img class="slide" src="ASSETS/img/pc.webp" alt="Slide 3">
    <img class="slide" src="ASSETS/img/home.jpg" alt="Slide 4">
    <img class="slide" src="ASSETS/img/school.webp" alt="Slide 5">

    <!-- Arrows -->
    <div class="hero-arrow left" id="prevSlide"><i class="ri-arrow-left-s-line"></i></div>
    <div class="hero-arrow right" id="nextSlide"><i class="ri-arrow-right-s-line"></i></div>
  </div>



  <div class="hero-content">
    <h1>IMARKET PH</h1>
    <p>Discover amazing deals and best-selling products.</p>
    <a href="#" class="hero-btn">Shop Now</a>
  </div>
</section>

    <section class="feature">
        <div class="middle-text">
            <h2>Discover More <span>Good Things.</span></h2>
        </div>
        <div class="feature-content">
            <div class="row">
                <div class="main-row">
                    <div class="row-text">
                        <h6>Explore New Arrivals</h6>
                        <h3>Give the Gift <br>of choice</h3>
                        <a href="#" class="row-btn">Show me all</a>
                    </div>
                    <div class="row-img">
                        <img src="ASSETS/img/kb.jpg" alt="" style="width: 130px;" >
                    </div>
                </div>
            </div>

            <div class="row row2">
                <div class="main-row">
                    <div class="row-text">
                        <h6>Explore New Arrivals</h6>
                        <h3>Give the Gift <br>of choice</h3>
                        <a href="#" class="row-btn">Show me all</a>
                    </div>
                    <div class="row-img">
                        <img src="ASSETS/img/clothes.webp" alt="" >
                    </div>
                </div>
            </div>

            <div class="row row3">
                <div class="main-row">
                    <div class="row-text">
                        <h6>Explore New Arrivals</h6>
                        <h3>Give the Gift <br>of choice</h3>
                        <a href="#" class="row-btn">Show me all</a>
                    </div>
                    <div class="row-img">
                        <img src="ASSETS/img/home.jpg" alt="" >
                    </div>
                </div>
            </div>
            
        </div>
    </section>
      <section class="product">
        <div class="middle-text">
            <h2>New Arrivals. <span>Best selling of the month</span></h2>
        </div>
        <div class="product-content">
            <div class="box">
                <div class="box-img">
                    <img src="ASSETS/img/kb.jpg" alt="">
                </div>
                <h3>Aula F75 Tri Mode Mechanical Keyboard</h3>
                <h4>New Release 2025</h4>
                <div class="inbox">
                     <div>
                        <a href="" class="price">$42.00</a>
                     </div>
                     <div class="rating">
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                     </div>
                </div>
                <div class="heart"> 
                    <i class="ri-heart-fill"></i>
                </div>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="ASSETS/img/mouse.jpg" alt="">
                </div>
                <h3>Attack Shark X11</h3>
                <h4>New Release 2025</h4>
                <div class="inbox">
                     <div>
                        <a href="" class="price">$30.00</a>
                     </div>
                     <div class="rating">
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                     </div>
                </div>
                <div class="heart"> 
                    <i class="ri-heart-fill"></i>
                </div>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="ASSETS/img/headset.jpg" alt="">
                </div>
                <h3>Gaming Headset</h3>
                <h4>New Release 2024</h4>
                <div class="inbox">
                     <div>
                        <a href="" class="price">$1000.00</a>
                     </div>
                     <div class="rating">
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                     </div>
                </div>
                <div class="heart"> 
                    <i class="ri-heart-fill"></i>
                </div>
            </div>


            <div class="box">
                <div class="box-img">
                    <img src="ASSETS/img/relo.jpg" alt="">
                </div>
                <h3>Rolex</h3>
                <h4>New Release 2024</h4>
                <div class="inbox">
                     <div>
                        <a href="" class="price">$50.00</a>
                     </div>
                     <div class="rating">
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                        <a href=""><i class="ri-star-fill"></i></a>
                     </div>
                </div>
                <div class="heart"> 
                    <i class="ri-heart-fill"></i>
                </div>
            </div>


        </div>
      </section>

      <section class="cta-content">
            <div class="cta">
                <div class="cta-text">
                    <a href="" class="logo"><img src="" alt=""></a>
                    <h3>Special offer in kids Products</h3>
                    <p style="color: black;">Fashion is A form of self-expression and autonomy at a particular period and place</p>
                    <a href="" class="btn">Discover here</a>
                </div>
            </div>
      </section> 

      <section class="contact">
         <div class="main-contact">
            <div class="contact-content">
                <h5>Getting started</h5>
                <li><a href="#">Release Notes</a></li>
                <li><a href="#">Upgrade Guide</a></li>
                <li><a href="#">Browser Support</a></li>
                <li><a href="#">Dark Mode</a></li>
            </div>

            <div class="contact-content">
                <h5>Explore</h5>
                <li><a href="#">Prototyping</a></li>
                <li><a href="#">Design System </a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Security</a></li>
            </div>

            <div class="contact-content">
                <h5>Resources</h5>
                <li><a href="#">Best Practices</a></li>
                <li><a href="#">Support</a></li>
                <li><a href="#">Developers</a></li>
                <li><a href="#">Learn Design</a></li>
            </div>

            <div class="contact-content">
                <h5>Community</h5>
                <li><a href="#">Discussion Forum</a></li>
                <li><a href="#">Code of Conduct</a></li>
                <li><a href="#">Contributing</a></li>
                <li><a href="#">API Reference</a></li>
            </div>
         </div>
      </section>
      <div class="end-text">
        <p>© 2025 All Rights Reserved by ImarketPH</p>
      </div>
      <script src="https://unpkg.com/scrollreveal"></script>
    <script src="ASSETS/js/script.js"></script>
</body>
</html>