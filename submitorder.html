<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; 
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];

   
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total, payment_method, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("ids", $user_id, $total_amount, $payment_method);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();


    $stmt = $conn->prepare("INSERT INTO payments (user_id, amount, status) VALUES (?, ?, 'Pending')");
    $stmt->bind_param("id", $user_id, $total_amount);
    $stmt->execute();
    $payment_id = $stmt->insert_id;
    $stmt->close();

   
    $items = [
        ['name' => 'Strawberry', 'price' => 50],
        ['name' => 'Vanilla', 'price' => 45],
        ['name' => 'Chocolate', 'price' => 55],
        ['name' => 'Mango', 'price' => 60]
    ];

    foreach ($items as $item) {
        if (isset($_POST[$item['name']])) {
            $quantity = $_POST[$item['name']];
            if ($quantity > 0) {
                $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isid", $order_id, $item['name'], $quantity, $item['price']);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    
    echo json_encode(['success' => true, 'order_id' => $order_id]);
} else {
    echo json_encode(['success' => false]);
}
?>
