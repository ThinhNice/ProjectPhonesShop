<?php
require_once('includes/conn.php');
header('Content-Type: application/json');

if (isset($_POST["order_code"]) && isset($_POST["status"])) {
    $status = $_POST["status"];
    $order_code = $_POST["order_code"];

    $sql = "UPDATE orders SET status = ? WHERE order_code = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "is", $status, $order_code);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật trạng thái.']);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => false, 'message' => 'Chuẩn bị câu lệnh thất bại.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ!']);
}
mysqli_close($conn);
?>