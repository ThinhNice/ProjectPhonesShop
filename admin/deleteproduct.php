<?php
require_once('./includes/admin-conect.php');

require_once('includes/conn.php');
$product_id = $_GET['id'];
// Chuẩn bị câu lệnh SQL với prepared statement
$stmt=$conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Thông báo xóa thành công và quay lại trang products.php
    echo "<script>
            alert('Product deleted successfully.');
            window.location.href='products.php';
          </script>";
} else {
    // Thông báo lỗi nếu không tìm thấy sản phẩm
    echo "<script>
            alert('No product found with this ID.');
            window.location.href='products.php';
          </script>";
}

// Đóng statement và kết nối
$stmt->close();
$stmt1->close();
$conn->close();
?>