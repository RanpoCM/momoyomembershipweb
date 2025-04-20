<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$new_tier = $_POST['new_tier'] ?? '';

if (empty($new_tier)) {
    header('Location: membershiptiers.php');
    exit();
}

$query = "SELECT membership_tier, username FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($current_tier, $username);
$stmt->fetch();
$stmt->close();

if ($new_tier == $current_tier) {
    $_SESSION['message'] = "You are already on the selected tier!";
    header("Location: membershiptiers.php");
    exit();
}

$price = 0;
$perks = [];

if ($new_tier === 'Classic') {
    $price = 150;
    $perks = [
        "Loyalty Card",
        "₱5 Discount",
        "1 Bonus Stamp Rewards",
        "Scratch Cards"
    ];
} elseif ($new_tier === 'Premium') {
    $price = 250;
    $perks = [
        "Loyalty Card",
        "₱10 Discount",
        "Exclusive Offers",
        "2 Bonus Stamp Rewards",
        "Exclusive Scratch Cards"
    ];
}

$gcash_payment_url = "https://checkout.gcash.com/payment-link?amount={$price}&description=Upgrade+to+{$new_tier}+Tier&reference=" . uniqid();
$paymaya_api_url = "https://pg-sandbox.paymaya.com/checkout/v1/checkouts";
$paymaya_api_key = "YOUR_PAYMAYA_API_KEY";

$data = array(
    "totalAmount" => array("currency" => "PHP", "value" => $price),
    "requestReferenceNumber" => uniqid(),
    "redirectUrl" => array(
        "success" => "http://yourwebsite.com/success.php",
        "failure" => "http://yourwebsite.com/cancel.php"
    ),
    "orderDescription" => "Upgrade to {$new_tier} Tier",
);

$data_json = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paymaya_api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $paymaya_api_key",
    "Content-Type: application/json"
));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response, true);

if (isset($response_data['paymentLink'])) {
    $paymaya_payment_link = $response_data['paymentLink'];
} else {
    $paymaya_payment_link = "#";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options | Momoyo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #ff99ca;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            height: 80px;
        }

        header .navbar-brand {
            color: #ff99ca;
            font-weight: 600;
            font-size: 1.8rem;
            cursor: default;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        header .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            object-fit: contain;
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

        .btn-upgrade {
            background-color: #4caf50;
            color: white;
            padding: 20px 40px;
            font-size: 1.5rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: block;
            width: 100%;
            max-width: 400px;
            margin: 10px auto;
        }

        .btn-upgrade:hover {
            background-color: #388e3c;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 20px;
        }

        .payment-header {
            text-align: center;
            margin-bottom: 30px;
        }

        footer {
            background-color: #ff99ca;
            color: #333;
            text-align: center;
            padding: 15px;
            width: 100%;
            bottom: 0;
            position: fixed;
        }

        .selected-tier {
            font-size: 1.5rem;
            color: #4caf50;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .perk-container {
            background-color: #ff99ca;
            border-radius: 10px; 
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .perk-container h4 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 15px;
        }

        .perk-item {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 10px;
        }

        .text-center {
            margin-bottom: 20px;
        }

        @media (max-width: 767px) {
            header .navbar-brand {
                font-size: 1.5rem;
            }

            header .navbar-brand img {
                width: 35px;
                height: 35px;
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
</header>

<div class="container">
    <div class="payment-header">
        <h2>Upgrade to <span class="selected-tier"><?php echo htmlspecialchars($new_tier); ?> Tier</span></h2>
        <p class="lead">You are about to upgrade to the <?php echo htmlspecialchars($new_tier); ?> tier for ₱<?php echo number_format($price, 2); ?>. Please complete the payment via one of the options below:</p>
    </div>

    <!-- Perks Container -->
    <div class="perk-container">
        <h4>Perks of the <?php echo htmlspecialchars($new_tier); ?> Tier:</h4>
        <ul class="list-unstyled">
            <?php foreach ($perks as $perk): ?>
                <li class="perk-item"><?php echo htmlspecialchars($perk); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="text-center">
        <a href="<?php echo $gcash_payment_url; ?>" target="_blank" class="btn-upgrade">Pay with GCash</a>
    </div>

    <div class="text-center">
        <a href="<?php echo $paymaya_payment_link; ?>" target="_blank" class="btn-upgrade">Pay with PayMaya</a>
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-dark" onclick="window.history.back();">← Back</button>
    </div>
</div>

<footer>
    <p>&copy; 2025 Momoyo. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
