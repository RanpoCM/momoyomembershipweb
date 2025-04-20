<?php
session_start();
require_once 'db_connect.php';

$current_page = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Locations | Momoyo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f9f9f9;
      color: #333;
      font-family: 'Arial', sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background-color: #ff99ca;
      color: #ff66b2;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header .navbar-brand {
      color: #ff66b2;
      font-weight: 600;
      font-size: 1.8rem;
      cursor: default; 
    }

    header .navbar-brand img {
      width: 40px;  
      height: 40px;
      animation: pulse 1.5s infinite alternate; 
    }

    @keyframes pulse {
      0% {
        transform: scale(1); 
        filter: brightness(1); 
      }
      50% {
        transform: scale(1.1); 
      }
      100% {
        transform: scale(1); 
      }
    }

    .navbar {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
    }

    .navbar-nav {
      display: flex;
      flex-direction: row;
      justify-content: flex-end;
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

    .nav-link.active {
      color: #ff66b2 !important;
      font-weight: bold;
      background-color: transparent;
    }

    .nav-link:hover {
      color: #ff66b2 !important;
      background-color: rgba(255, 102, 178, 0.1);
    }

    .location-card-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
      gap: 30px; 
      justify-items: center; 
      padding: 20px;
    }

    .location-card {
      background: #fff;
      border: 2px solid #ff66b2;
      border-radius: 15px;
      padding: 15px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 350px;
      width: 100%;
      margin: 0 auto;
    }

    .location-card img {
      width: 100%;
      height: auto;
      max-height: 200px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .location-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 8px 20px rgba(255, 102, 178, 0.3);
    }

    .location-card h4 {
      color: #ff66b2;
      font-size: 1.4rem;
      margin-bottom: 10px;
    }

    .location-card .btn {
      font-size: 1.1rem;
      padding: 8px 20px;
      background-color: #ff66b2;
      color: white;
      border-radius: 8px;
      font-weight: 500;
    }

    .location-card .btn:hover {
      background-color: #e0559c;
      text-decoration: none;
    }

    footer {
      background-color: #ff99ca;
      color: #333;
      text-align: center;
      padding: 15px;
      width: 100%;
      margin-top: auto; 
      position: relative;
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

      section h2 {
        font-size: 1.6rem;
      }

      .location-card {
        margin-bottom: 30px;
      }

      .location-card img {
        height: 180px;
      }

      footer {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <a class="navbar-brand text-white" href="#">
      <img src="momoyo.png" alt="Momoyo Logo" />
      Momoyo
    </a>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto"> 
          <li class="nav-item">
            <a class="nav-link <?= $current_page === 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current_page === 'profile.php' ? 'active' : '' ?>" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current_page === 'locations.php' ? 'active' : '' ?>" href="locations.php">Locations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <section class="container py-5">
    <h2 class="section-title text-center text-uppercase mb-4" style="color: #ff66b2;">Explore Our Locations</h2>
    <div class="location-card-container">
      <div class="location-card">
        <img src="metroplazabranch.jpg" alt="Metro Plaza">
        <h4>Metro Plaza</h4>
        <p>Located at the heart of the city, Metro Plaza offers a modern shopping experience. Visit us for exclusive offers!</p>
        <a href="https://g.co/kgs/GVsbNMh" target="_blank" class="btn">View on Map</a>
      </div>

      <div class="location-card">
        <img src="smfairviewbranch.jpg" alt="SM City Fairview">
        <h4>SM City Fairview</h4>
        <p>Our branch at SM City Fairview is packed with the latest trends. Drop by for exciting promotions and events!</p>
        <a href="https://g.co/kgs/AyiAmLR" target="_blank" class="btn">View on Map</a>
      </div>

      <div class="location-card">
        <img src="tarlacbranch.jpg" alt="SM Tarlac">
        <h4>SM Tarlac</h4>
        <p>Our SM Tarlac branch is a great place to shop and relax. Come and enjoy our exclusive services!</p>
        <a href="https://g.co/kgs/9MyQTfT" target="_blank" class="btn">View on Map</a>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <footer>
    <p>&copy; 2025 Momoyo. All rights reserved.</p>
  </footer>

</body>
</html>
