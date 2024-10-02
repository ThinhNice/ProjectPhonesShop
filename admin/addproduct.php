<?php
require_once('./includes/admin-conect.php')
?>
<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product </title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tiny.cloud/1/gdw2jh7mi0hv7z710s22nw1odgko9iugse9hn5oazht3xfyp/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

</head>

<body>
    <?php
    require('includes/conn.php');
    ?>
    <div class="form-container">
        <h2>Add Product</h2>
        <form action="addproduct.php" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
                <?php

                ?>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <?php
                    $sql = 'SELECT name FROM categories';
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"{$row['name']}\">{$row['name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>

            </div>

            <div class="form-group">
                <label for="price">Price(VND):</label>
                <input type="number" id="price" name="price" min="0" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" min="0" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image[]" multiple required>
            </div>

            <div class="form-group">
                <button type="submit" name="button">Add Product</button>
            </div>
        </form>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    <?php
// Kiểm tra xem đã bấm nút chưa
if (isset($_POST["button"])) {
    // Lấy giá trị từ form
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Kiểm tra xem tên sản phẩm có bị trùng không
    $sql_check = "SELECT id FROM products WHERE name = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $name);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    mysqli_stmt_close($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>
            alert('Product name already exists. Please choose another name.');
            window.history.back();
          </script>";
    } else {
        // Kiểm tra file ảnh trước khi lưu sản phẩm
        $total_files = count($_FILES['image']['name']);
        $uploaded_files = [];
        $target_dir = '../upload_files/';
        $valid_images = true;

        for ($i = 0; $i < $total_files; $i++) {
            $target_file = $target_dir . basename($_FILES['image']['name'][$i]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra xem file có phải là ảnh không
            if (getimagesize($_FILES["image"]["tmp_name"][$i]) === false) {
                echo "<script>
                alert('File " . $_FILES["image"]["name"][$i] . " không phải là ảnh.');
                window.history.back();
                </script>";
                $valid_images = false;
                break;
            }

            // Kiểm tra kích thước file
            if ($_FILES["image"]["size"][$i] > 2000000) {
                echo "<script>
                alert('File " . $_FILES["image"]["name"][$i] . " quá lớn.');
                window.history.back();
                </script>";
                $valid_images = false;
                break;
            }

            // Kiểm tra định dạng file
            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                echo "<script>
                alert('Chỉ cho phép các định dạng JPG, JPEG, PNG, GIF cho file " . $_FILES["image"]["name"][$i] . ".');
                window.history.back();
                </script>";
                $valid_images = false;
                break;
            }

            // Nếu tất cả kiểm tra đều ok, lưu vào mảng
            if ($valid_images) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {
                    $uploaded_files[] = $target_file;
                } else {
                    echo "<script>
                    alert('Có lỗi khi tải file " . $_FILES["image"]["name"][$i] . ".');
                    window.history.back();
                    </script>";
                    $valid_images = false;
                    break;
                }
            }
        }

        // Nếu tất cả ảnh hợp lệ, tiếp tục thêm sản phẩm
        if ($valid_images) {
            // Lấy category_id từ bảng categories
            $sql = "SELECT id FROM categories WHERE name = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $category_id = $row['id'];

                // Chèn sản phẩm vào bảng products
                $sql = 'INSERT INTO products (category_id, name, description, price, stock) VALUES (?, ?, ?, ?, ?)';
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "issii", $category_id, $name, $description, $price, $stock);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                // Lấy product_id của sản phẩm mới thêm
                $product_id = mysqli_insert_id($conn);

                // Lưu ảnh vào bảng product_images
                foreach ($uploaded_files as $uploaded_file) {
                    $sql = "INSERT INTO product_images (product_id, image_url) VALUES (?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "is", $product_id, $uploaded_file);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }

                echo "<script>
                    alert('Product added successfully.');
                    window.location.href='products.php';
                  </script>";
            }
        }
    }
}

mysqli_close($conn);
?>
</body>

</html>