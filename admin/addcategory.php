<?php
require_once('./includes/admin-conect.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.form-container {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 400px;
    margin: auto;
}

h2 {
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}

p {
    text-align: center;
}

.error-message {
    color: red;
    text-align: center;
}

.success-message {
    color: green;
    text-align: center;
}
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Add New Category</h2>
        <form action="addcategory.php" method="POST">
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <button type="submit" name="btnsubmit">Add New Category</button>
            </div>
        </form>

        <?php
        require_once("includes/conn.php");

        // Kiểm tra xem người dùng đã nhấn nút submit chưa
        if (isset($_POST["btnsubmit"])) {
            $name = $_POST['name'];

            // Kiểm tra nếu danh mục đã tồn tại
            $checkSql = "SELECT COUNT(*) FROM categories WHERE name = ?";
            $checkStmt = mysqli_prepare($conn, $checkSql);
            mysqli_stmt_bind_param($checkStmt, "s", $name);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_bind_result($checkStmt, $count);
            mysqli_stmt_fetch($checkStmt);
            mysqli_stmt_close($checkStmt);

            if ($count > 0) {
                echo "<p class='error-message'>Category already exists!</p>";
            } else {
                // Chèn danh mục vào bảng categories
                $sql = "INSERT INTO categories(name) VALUES(?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $name);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    // Chuyển hướng về category.php với thông báo thành công
                    echo "<script>
                    alert('Category created successfully.');
                    window.location.href='category.php';
                    </script>";
                } else {
                    echo "<p class='error-message'>Error adding category: " . mysqli_error($conn) . "</p>";
                }
                mysqli_stmt_close($stmt);
            }
        }

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>