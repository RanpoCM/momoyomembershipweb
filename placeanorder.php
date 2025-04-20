<?php
session_start();
require_once 'db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];
    $order_items = json_decode($_POST['order_items'], true);

    
    $order_query = "INSERT INTO orders (payment_method, total_amount, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("sdi", $payment_method, $total_amount, $_SESSION['user_id']);
    $stmt->execute();

    
    $order_id = $stmt->insert_id; 
    foreach ($order_items as $item) {
        $item_query = "INSERT INTO order_items (order_id, flavor, quantity, price) VALUES (?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_query);
        $item_stmt->bind_param("isid", $order_id, $item['flavor'], $item['quantity'], $item['price']);
        $item_stmt->execute();
    }


    header('Location: order_confirmation.php');
    exit();
} else {
 
    header('Location: index.php');
    exit();
}
?>
