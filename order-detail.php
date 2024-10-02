<?php
session_start();

if (isset($_SESSION['success_message1'])) {
    echo '<div id="toast" class="toast show">' . $_SESSION['success_message1'] . '</div>';
    unset($_SESSION['success_message1']); 
}

require_once("./nav.php");
require_once("./connect-sql.php");

if (!isset($_GET['order_code'])) {
    die("Mã đơn hàng không hợp lệ.");
}

$order_code = $conn->real_escape_string($_GET['order_code']);

$sql_order = "SELECT * FROM orders WHERE order_code = '$order_code'";
$result_order = $conn->query($sql_order);

if ($result_order->num_rows == 0) {
    die("Không tìm thấy đơn hàng với mã: " . htmlspecialchars($order_code));
}

$order = $result_order->fetch_assoc();

$sql_details = "SELECT * FROM order_details WHERE order_id = " . $order['id'];
$result_details = $conn->query($sql_details);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Chi Tiết Đơn Hàng</h2>
        <h4>Mã Đơn Hàng: <?php echo htmlspecialchars($order['order_code']); ?></h4>
        <h5>Thông Tin Khách Hàng:</h5>
        <p>Họ và Tên: <?php echo htmlspecialchars($order['fullname']); ?></p>
        <p>Email: <?php echo htmlspecialchars($order['email']); ?></p>
        <p>Số Điện Thoại: <?php echo htmlspecialchars($order['phone']); ?></p>
        <p>Địa Chỉ: <?php echo htmlspecialchars($order['received_address']); ?></p>
        <p>Tổng Số Tiền: <?php echo number_format($order['total_amount'], 0, ',', '.') . 'đ'; ?></p>
        <p>Trạng Thái:
            <?php 
            switch ($order['status']) {
                case '0':
                    echo 'Đặt thành công';
                    break;
                case '1':
                    echo 'Đang vận chuyển';
                    break;
                case '2':
                    echo 'Đã nhận';
                    break;
                case '4':
                    echo 'Hủy đơn';
                    break;
                default:
                    echo 'Trạng thái không xác định';
                    break;
            }
            ?>
        </p>
        <hr>

        <h5>Chi Tiết Sản Phẩm:</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $result_details->fetch_assoc()): ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($item['product_img']); ?>"
                            alt="<?php echo htmlspecialchars($item['cur_pr_name']); ?>" width="50"></td>
                    <td><?php echo htmlspecialchars($item['cur_pr_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo number_format($item['cur_pr_price'], 0, ',', '.') . 'đ'; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script>
    window.onload = function() {
        var toast = document.getElementById("toast");
        if (toast) {
            setTimeout(function() {
                toast.classList.remove("show");
            }, 2000);
        }
    };
    </script>
</body>

</html>
<?php
require_once("./footer.php");
$conn->close();
?>