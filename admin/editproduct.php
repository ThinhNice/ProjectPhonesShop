<?php
require_once('./includes/admin-conect.php');

require_once("includes/conn.php");

// Kiểm tra xem có ID sản phẩm được truyền từ URL không
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT 
                products.id AS product_id,
                products.name AS product_name,
                products.description,
                products.price,
                products.stock,
                categories.name AS category_name,
                categories.id AS category_id
            FROM 
                products
            INNER JOIN 
                categories ON products.category_id = categories.id
            WHERE 
                products.id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    // Kiểm tra xem sản phẩm có tồn tại không
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Invalid product ID!";
    exit;
}

// Tạo mảng lưu lỗi
$errors = [];

// Xử lý khi người dùng gửi form
if (isset($_POST["btnsubmit"])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category'];
    
    // Kiểm tra lỗi
   

    if (empty($description)) {
        $errors['description'] = "Description is required.";
    }

    if (empty($price) || $price <= 0) {
        $errors['price'] = "Valid price is required.";
    }

    if (empty($stock) || $stock < 0) {
        $errors['stock'] = "Valid stock is required.";
    }

    if (empty($category_id)) {
        $errors['category'] = "Category is required.";
    }

    // Nếu không có lỗi, tiến hành cập nhật
    if (count($errors) === 0) {
        // Cập nhật thông tin sản phẩm
        $updateSql = "UPDATE products SET name = ?, description = ?, price = ?, stock = ?, category_id = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ssiiii", $name, $description, $price, $stock, $category_id, $product_id);

        if (mysqli_stmt_execute($updateStmt)) {
            mysqli_stmt_close($updateStmt);
            // Chuyển hướng về trang danh sách sản phẩm với thông báo thành công
            echo "<script>
            alert('Product changed successfully.');
            window.location.href='products.php';
            </script>";
        } 
    }
}

// Lấy danh sách danh mục để hiển thị trong dropdown
$categoriesSql = "SELECT * FROM categories";
$categoriesResult = mysqli_query($conn, $categoriesSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .error { color: red; font-size: 12px; }
    </style>
    <script src="https://cdn.tiny.cloud/1/gdw2jh7mi0hv7z710s22nw1odgko9iugse9hn5oazht3xfyp/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
</head>

<body>

    <div class="form-container">
        <h2>Edit Product</h2>
        <form action="editproduct.php?id=<?php echo $product_id; ?>" method="POST">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['product_name']; ?>" required>
                <!-- Hiển thị lỗi nếu có -->
                <?php if (isset($errors['name'])): ?>
                    <div class="error"><?php echo $errors['name']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea>
                <!-- Hiển thị lỗi nếu có -->
                <?php if (isset($errors['description'])): ?>
                    <div class="error"><?php echo $errors['description']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                <!-- Hiển thị lỗi nếu có -->
                <?php if (isset($errors['price'])): ?>
                    <div class="error"><?php echo $errors['price']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" value="<?php echo $row['stock']; ?>" required>
                <!-- Hiển thị lỗi nếu có -->
                <?php if (isset($errors['stock'])): ?>
                    <div class="error"><?php echo $errors['stock']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <?php
                    while ($category = mysqli_fetch_assoc($categoriesResult)) {
                        echo "<option value='" . $category['id'] . "'" . ($category['id'] == $row['category_id'] ? " selected" : "") . ">" . $category['name'] . "</option>";
                    }
                    ?>
                </select>
                <!-- Hiển thị lỗi nếu có -->
                <?php if (isset($errors['category'])): ?>
                    <div class="error"><?php echo $errors['category']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <button type="submit" name="btnsubmit">Update Product</button>
            </div>
        </form>
    </div>

    <?php
    mysqli_close($conn);
    ?>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
</body>

</html>