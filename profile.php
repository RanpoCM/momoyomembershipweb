<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, membership_tier, profile_picture FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $membership_tier, $profile_picture);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile | Momoyo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f9f9f9;
      color: #333;
      font-family: 'Arial', sans-serif;
      margin-top: 80px;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background-color: #ff99ca;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    header .navbar-brand {
      color: #ff99ca;
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
        opacity: 1;
      }
      50% {
        transform: scale(1.2);
        opacity: 0.8;
      }
      100% {
        transform: scale(1);
        opacity: 1;
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
    }

    footer {
      background-color: #ff99ca;
      color: #333;
      text-align: center;
      padding: 15px;
      width: 100%;
      position: relative;
      bottom: 0;
      margin-top: auto;
    }

    .profile-container {
      max-width: 800px;
      margin: auto;
      padding: 40px 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin-top: 100px;
    }

    .profile-picture img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #ffc0cb;
    }

    .profile-info h2 {
      margin-top: 15px;
    }

    .membership-tier {
      display: inline-block;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: bold;
      margin-top: 20px;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .membership-tier.Classic {
      background-color: #ffc0cb;
      color: #333;
    }

    .membership-tier.Premium {
      background-color: #ff66b2;
      color: #fff;
    }

    .membership-tier.Trial {
      background-color: #f0ad4e;
      color: #fff;
    }

    .membership-tier.Free {
      background-color: #28a745;
      color: #fff;
      animation: pulseFree 2s infinite ease-in-out;
    }

    @keyframes pulseFree {
      0% {
        transform: scale(1);
        background-color: #28a745;
      }
      50% {
        transform: scale(1.05);
        background-color: #218838;
      }
      100% {
        transform: scale(1);
        background-color: #28a745;
      }
    }

    .btn-pink {
      background-color: #ff69b4;
      border: none;
      color: white;
    }

    .btn-pink:hover {
      color: white;
      background-color: #c13572;
    }

    
    .navbar-toggler {
      border-color: #ff99ca;
    }

    .navbar-toggler-icon {
      background-color: #ff99ca;
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
    <a class="navbar-brand text-white" href="javascript:void(0);"> 
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
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'profile.php') ? 'active' : ''; ?>" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'locations.php') ? 'active' : ''; ?>" href="locations.php">Locations</a>
          </li>

          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? 'active' : ''; ?>" href="logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'active' : ''; ?>" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'register.php') ? 'active' : ''; ?>" href="register.php">Register</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container my-5">
    <div class="profile-container">
      <div class="profile-picture">
        <img src="<?php echo $profile_picture ? 'uploads/' . htmlspecialchars($profile_picture) : 'images/default-profile.jpg'; ?>" alt="Profile Picture">
      </div>

      <div class="profile-info mt-3">
        <h2><?php echo htmlspecialchars($username); ?></h2>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Membership Tier:</p>
        <div class="membership-tier <?php echo htmlspecialchars($membership_tier); ?>" data-bs-toggle="modal" data-bs-target="#membershipModal">
          <?php echo htmlspecialchars($membership_tier); ?>
        </div>
      </div>

      <div class="customer-service-section mt-4">
        <h3>Customer Service</h3>
        <p>If you have any questions or need assistance, feel free to contact our support team!</p>
        <p>Email: <a href="mailto:support@momoyo.com">support@momoyo.com</a></p>
      </div>

      <div class="feedback-section mt-4">
        <h3>Feedback</h3>
        <p>We'd love to hear from you! Please share your feedback about your experience with Momoyo.</p>
        <form action="submit_feedback.php" method="POST">
          <div class="mb-3">
            <label for="feedback" class="form-label">Your Feedback</label>
            <textarea id="feedback" name="feedback" class="form-control" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-pink">Submit Feedback</button>
        </form>
      </div>

      <div class="settings-section mt-4">
        <h3>Settings</h3>
        <p>Manage your account settings below:</p>
        <a href="changepassword.php" class="btn btn-secondary">Change Password</a>
        <a href="updateprofile.php" class="btn btn-secondary">Update Profile</a>
      </div>
    </div>
  </div>

  <div class="modal fade" id="membershipModal" tabindex="-1" aria-labelledby="membershipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="membershipModalLabel">Membership Perks</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if ($membership_tier === "Free"): ?>
            <h5>Free Membership Perks</h5>
            <p>As a Free member, you enjoy the following perks:</p>
            <ul>
              <li>Access to basic features.</li>
              <li>Limited support options.</li>
              <li>Exclusive Free Member promotions.</li>
            </ul>
          <?php else: ?>
            <p>No additional perks available for your current membership tier.</p>
          <?php endif; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Momoyo. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
