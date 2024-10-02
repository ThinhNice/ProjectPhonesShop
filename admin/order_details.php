<?php
require_once('./includes/admin-conect.php');

if (isset($_SESSION['success_message1'])) {
    echo '<div id="toast" class="toast show">' . $_SESSION['success_message1'] . '</div>';
    unset($_SESSION['success_message1']);
}
require_once("includes/header.php");
require_once("includes/conn.php");

// Kiểm tra nếu có mã đơn hàng
if (!isset($_GET['order_code'])) {
    die("Mã đơn hàng không hợp lệ.");
}

$order_code = $conn->real_escape_string($_GET['order_code']);

// Lấy thông tin đơn hàng từ bảng orders
$sql_order = "SELECT * FROM orders WHERE order_code = '$order_code'";
$result_order = $conn->query($sql_order);
if ($result_order->num_rows == 0) {
    die("Không tìm thấy đơn hàng với mã: " . htmlspecialchars($order_code));
}

$order = $result_order->fetch_assoc();

// Lấy thông tin chi tiết đơn hàng từ bảng order_details
$sql_details = "SELECT * FROM order_details WHERE order_id = " . $order['id'];
$result_details = $conn->query($sql_details);

$status_text = '';
switch ($order['status']) {
    case 0:
        $status_text = 'Đặt thành công';
        break;
    case 1:
        $status_text = 'Đang vận chuyển';
        break;
    case 2:
        $status_text = 'Đã nhận';
        break;
    case 3:
        $status_text = 'Hủy đơn';
        break;
    default:
        $status_text = 'Không xác định';
        break;
}
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
        <!-- Default dropright button -->
        <div class="btn-group dropright">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Trạng thái:<span id="current-status"><?php echo " ". htmlspecialchars($status_text); ?></span>
            </button>
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item" href="#" data-value="0">Đặt thành công</a>
                <a class="dropdown-item" href="#" data-value="1">Đang vận chuyển</a>
                <a class="dropdown-item" href="#" data-value="2">Đã nhận</a>
                <a class="dropdown-item" href="#" data-value="3">Hủy đơn</a>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                // Khi người dùng click vào mục trong dropdown
                $('.dropdown-item').click(function (e) {
                    e.preventDefault();
                    var status = $(this).data('value');
                    var ordercode = <?php echo json_encode($order_code); ?>; 

                    // Gửi AJAX request đến server để cập nhật trạng thái đơn hàng
                    $.ajax({
                        url: 'update-status.php', // Đường dẫn đến file PHP mới tạo
                        method: 'POST',
                        data: {
                            order_code: ordercode,
                            status: status
                        },
                        success: function (response) {
                            if (response.success) {
                                alert(response.message);
                                // Có thể cập nhật giao diện ở đây, ví dụ thay đổi text nút
                                $('.btn-secondary').text('Trạng thái: ' + $(e.target).text());
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            // Xử lý lỗi
                            alert('Có lỗi xảy ra, vui lòng thử lại!');
                            console.log('Error:', error);
                        }
                    });
                });
            });
        </script>
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
        window.onload = function () {
            var toast = document.getElementById("toast");
            if (toast) {
                setTimeout(function () {
                    toast.classList.remove("show");
                }, 2000);
            }
        };
    </script>
</body>

</html>
<?php
require_once("includes/footer.php");
?>