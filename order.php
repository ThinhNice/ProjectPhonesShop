<?php
ob_start();
session_start();
require("./nav.php");
require_once("./connect-sql.php");

$total = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['product_price'] * $item['quantity'];
    }
}

function generateOrderCode() {
    $randomString = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
    return 'ORDER-' . $randomString;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnDatHang'])) {
    $fullname = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $total_amount = $_POST['total']; 
    $order_code = generateOrderCode();
    $payment_method = '0'; 
    $status = '0'; 
    $created_at = date('Y-m-d H:i:s'); 

    $sql = "INSERT INTO orders (fullname, email, received_address, phone, order_code, total_amount, status, payment_method, created_at)
            VALUES ('$fullname', '$email', '$address', '$phone', '$order_code', '$total_amount', '$status', '$payment_method', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        
        $order_id = $conn->insert_id; 
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product_img = $conn->real_escape_string($item['first_image']);
                $cur_pr_name = $conn->real_escape_string($item['product_name']);
                $quantity = $item['quantity'];
                $cur_pr_price = $item['product_price'];
    
                $sql_detail = "INSERT INTO order_details (order_id, product_img, cur_pr_name, quantity, cur_pr_price)
                               VALUES ('$order_id', '$product_img', '$cur_pr_name', '$quantity', '$cur_pr_price')";
    
                if (!$conn->query($sql_detail)) {
                    echo "Lỗi lưu thông tin sản phẩm: " . $conn->error;
                }
            }
            unset($_SESSION['cart']);
        }
        $_SESSION['success_message1'] = "Order placed successfully!";
        header("location: /order-detail.php?order_code=$order_code");
        exit(); 
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ob_end_flush();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
</head>

<body>
    <div class="tox-editor-container"></div>
    <div class="container mt-2">
        <div class="py-5 text-center">
            <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
            <h2>Thanh toán</h2>
            <p class="lead">Vui lòng điền thông tin cá nhân, kiểm tra giỏ hàng trước khi đặt hàng.</p>
        </div>
        <div class="container mt-2 ">
            <div class="row ">
                <div class="col-sm-6">
                    <h4 class="text-muted">Thông tin cá nhân</h4>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập họ tên của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Nhập số điện thoại của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Nhập email của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="address" name="address" rows="3"
                                placeholder="Nhập địa chỉ của bạn" required></textarea>
                        </div>
                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                        <button class="btn btn-primary btn-lg btn-block w-100" type="submit" name="btnDatHang">Đặt
                            hàng</button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Giỏ hàng</span>
                        <span class="badge bg-secondary badge-pill"><?php echo count($_SESSION['cart']); ?></span>
                    </h4>

                    <ul class="list-group mb-3">
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <input type="hidden" name="sanphamgiohang[<?php echo $index; ?>][gia]"
                            value="<?php echo htmlspecialchars($item['product_price']); ?>">
                        <input type="hidden" name="sanphamgiohang[<?php echo $index; ?>][soluong]"
                            value="<?php echo htmlspecialchars($item['quantity']); ?>">

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo htmlspecialchars($item['first_image']); ?>"
                                    alt="<?php echo htmlspecialchars($item['product_name']); ?>" width="50"
                                    class="me-3">
                                <div>
                                    <h6 class="my-0"><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                    <small class="text-muted">Giá:
                                        <?php echo number_format($item['product_price'], 0, ',', '.'); ?>đ X
                                        <?php echo htmlspecialchars($item['quantity']); ?></small>
                                </div>
                            </div>
                            <div>
                                <span class="text-muted">Giá:
                                    <?php echo number_format($item['product_price'] * $item['quantity'], 0, ',', '.') . 'đ'; ?></span>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <li class="list-group-item">
                            Giỏ hàng của bạn trống.
                        </li>
                        <?php endif; ?>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tổng thành tiền</span>
                            <strong>
                                <?php 
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $item) {
                                        $total += $item['product_price'] * $item['quantity'];
                                    }
                                    echo number_format($total, 0, ',', '.') . 'đ';
                                ?>
                            </strong>
                        </li>
                    </ul>

                    <h4 class="mb-3 text-muted">Hình thức thanh toán</h4>
                    <div class="d-block my-3">
                        <h6>Thanh toán khi nhận hàng</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
require("footer.php");
?>