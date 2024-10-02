<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'] ?? null;
    $action = $_POST['action'] ?? null;
    $productPrice = $_POST['product_price'] ?? null;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($productName) {
        $productFound = false;
        
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_name'] === $productName) {
                $productFound = true;

                if ($action === 'increase') {
                    $item['quantity']++;
                } elseif ($action === 'decrease' && $item['quantity'] > 1) {
                    $item['quantity']--;
                } elseif ($action === 'remove') {
                    unset($_SESSION['cart'][$key]);
                }

                $item['total_price'] = $item['product_price'] * $item['quantity'];
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    echo json_encode([
        'status' => 'success',
        'cart_count' => count($_SESSION['cart']),
        'cart' => $_SESSION['cart']
    ]);
}
?>
