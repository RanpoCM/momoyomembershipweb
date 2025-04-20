<?php 
session_start();
require_once 'db_connect.php';

$isLoggedIn = isset($_SESSION['user_id']);
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home | Momoyo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fafaf0;
      color: black;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    header {
      background-color: #ff99ca;
      color: pink;
      padding: 50px 20px 20px;
      text-align: center;
      animation: fadeIn 1.5s ease-out;
    }

    footer {
      background-color: #ff99ca;
      color: #333;
      text-align: center;
      padding: 15px;
      width: 100%;
      bottom: 0;
      position: bottom;
    }

    .navbar {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      justify-content: space-between;
    }

    .navbar-nav {
      display: flex;
      flex-direction: row;
      padding-left: 0;
    }

    .nav-item {
      margin-left: 15px;
    }

    .nav-link {
      color: #fff !important;
      font-weight: 500;
      padding: 8px 16px;
      text-decoration: none;
    }

    .nav-link:hover {
      color:#ff66b2 !important;
    }

    .nav-link.active {
      color: #ff66b2 !important;
      font-weight: bold;
    }

    .product-card {
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 15px;
      background-color: white;
      overflow: hidden;
      height: 450px;
    }

    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .product-card-body {
      padding: 20px;
    }

    .product-title {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .product-card-body p {
      font-size: 1rem;
      color: #666;
    }

    .action-buttons-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 30px;
      margin-top: 20px; 
    }

    .action-button {
      font-size: 1.5rem;
      padding: 12px 35px;
      background-color: pink;
      margin-top: -100px; 
      color: black;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      background-color: #fcd2d9;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .action-button:hover {
      background-color: #ff99ca;
      transform: scale(1.05);
    }

    .action-button:focus {
      outline: none;
    }

    a {
      text-decoration: none; 
    }

    .container {
      padding: 60px 20px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 1s ease-out;
    }

    .logo-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: -20px;
      animation: logoFadeIn 2s ease-out;
    }

    .logo {
      width: 150px;
      height: auto;
      border-radius: 10px;
      transition: all 0.5s ease-in-out;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      animation: pulse 1.5s infinite ease-in-out;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    @keyframes logoFadeIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    .logo:hover {
      transform: scale(1.05);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      border-radius: 15px;
    }

    .store-description {
      font-size: 1.2rem;
      color: white;
      margin-top: 120px;
      text-align: center;
      font-style: italic;
      background-color: #000;
      padding: 40px;
    }

    button {
      background-color: transparent;
      border: solid white; 
    }

    h1, p {
      color: white;
    }

    .pinkbg {
      background-color: #ff99ca !important;
    }

    @media (max-width: 768px) {
      .navbar-nav {
        flex-direction: column; 
        margin-left: 0;
        padding-left: 0;
        width: 100%;
      }

      .nav-item {
        margin-top: 15px;
        margin-left: 0; 
        width: 100%;
        text-align: left; 
      }

      .nav-link {
        padding: 8px 20px; 
      }

      .navbar-toggler-icon {
        background-color: #ff99ca;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="logo-container">
    <img src="momoyo.png" alt="Momoyo Logo" class="logo">
  </div>
  <h1>Welcome to Momoyo!</h1>
  <p>Delicious Ice Cream and Iced Coffee with a Twist</p>

  <?php if (!$isLoggedIn): ?>
    <div class="action-buttons-container">
      <a href="login.php">
        <button class="action-button">Login</button>
      </a>
      &nbsp;
      <a href="register.php">
        <button class="action-button">Register</button>
      </a>
    </div>
  <?php endif; ?>
  <?php if ($isLoggedIn): ?>
    <nav class="navbar navbar-expand-lg navbar-dark pinkbg mt-3">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="javascript:void(0);">
        &nbsp;
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>" href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'locations.php') ? 'active' : ''; ?>" href="locations.php">Locations</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="about.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <?php endif; ?>
</header>



<section class="container py-5">
  <h2 class="text-center mb-4 fade-in">Our Products</h2>
  <div class="row">
    <div class="col-md-4 mb-4 fade-in">
      <div class="product-card">
        <img src="Product1.jpeg" alt="Strawberry">
        <div class="product-card-body">
          <h5 class="product-title">Strawberry</h5>
          <p>Indulge in the vibrant and refreshing sweetness of strawberry ice cream. With its perfectly balanced tartness and smooth texture, it's a treat that will leave you craving more!</p>

          <?php if (!$isLoggedIn): ?>
            <a href="productdetails.php?id=1">
              <button class="action-button">View</button>
            </a>
          <?php else: ?>
            <a href="productdetails.php?id=1">
              <button class="action-button">View</button>
            </a>
            &nbsp;
            <a href="order.html">
              <button class="action-button">Place Order</button>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4 fade-in">
      <div class="product-card">
        <img src="Product1.jpeg" alt="Vanilla">
        <div class="product-card-body">
          <h5 class="product-title">Vanilla</h5>
          <p>Experience the creamy richness of our premium vanilla ice cream, made with the finest ingredients. Perfectly smooth and indulgent, it's the ultimate classic flavor!</p>

          <?php if (!$isLoggedIn): ?>
            <a href="productdetails.php?id=2">
              <button class="action-button">View</button>
            </a>
          <?php else: ?>
            <a href="productdetails.php?id=2">
              <button class="action-button">View</button>
            </a>
            &nbsp;
            <a href="order.html?id=2">
              <button class="action-button">Place Order</button>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4 fade-in">
      <div class="product-card">
        <img src="Product1.jpeg" alt="Chocolate">
        <div class="product-card-body">
          <h5 class="product-title">Chocolate</h5>
          <p>Indulge in the ultimate chocolate lover's dream! Our rich, delicious, and yummy chocolate ice cream will melt in your mouth and satisfy your deepest cravings.</p>

          <?php if (!$isLoggedIn): ?>
            <a href="productdetails.php?id=3">
              <button class="action-button">View</button>
            </a>
          <?php else: ?>
            <a href="productdetails.php?id=3">
              <button class="action-button">View</button>
            </a>
            &nbsp;
            <a href="order.html?id=3">
              <button class="action-button">Place Order</button>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4 fade-in">
      <div class="product-card">
        <img src="Product1.jpeg" alt="Mango">
        <div class="product-card-body">
          <h5 class="product-title">Mango</h5>
          <p>Escape to a tropical paradise with the refreshing taste of mango! This sweet, creamy ice cream is perfect for those who crave a bright, fruity experience.</p>

          <?php if (!$isLoggedIn): ?>
            <a href="productdetails.php?id=4">
              <button class="action-button">View</button>
            </a>
          <?php else: ?>
            <a href="productdetails.php?id=4">
              <button class="action-button">View</button>
            </a>
            &nbsp;
            <a href="order.html?id=4">
              <button class="action-button">Place Order</button>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="store-description">
  <p>Welcome to <strong>Momoyo</strong> – your go-to destination for indulgence and refreshment! Step into a world where creamy, handcrafted ice cream meets the rich, bold flavors of iced coffee. At Momoyo, we bring you an unforgettable experience with every scoop and sip, creating moments of pure joy with every treat. Whether you're craving a sweet and smooth sundae or a refreshing iced coffee, our menu is designed to satisfy your taste buds and brighten your day. Join us for a delightful experience that blends quality, taste, and a touch of sweetness. Welcome to <strong>Momoyo</strong>, where every visit feels like a sweet escape.</p>
</div>

<footer>
  <p>&copy; 2025 Momoyo. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
