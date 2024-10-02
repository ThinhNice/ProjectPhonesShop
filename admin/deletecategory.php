<?php
require_once('./includes/admin-conect.php');
require_once('includes/conn.php');

// Kiểm tra xem có ID category được truyền vào không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Chuẩn bị câu lệnh DELETE
    $sql = 'DELETE FROM categories WHERE id= ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);


    // Kiểm tra xem có dòng nào bị ảnh hưởng (tức là category đã bị xóa)
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>
        alert('Category deleted successfully, but some products related to this category deleted.');
        window.location.href='category.php';
        </script>";
    } else {
        echo "<script>
        alert('No category found with this ID.');
        window.location.href='category.php';
        </script>"; 
    }
    mysqli_stmt_close($stmt);
} else {
    // Nếu không có ID nào được truyền vào
    echo "<script>
    alert('Invalid category ID.');
    window.location.href='category.php';
    </script>";
}
?>