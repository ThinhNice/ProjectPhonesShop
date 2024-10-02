<?php
require_once('./includes/admin-conect.php');

require_once('includes/header.php');

$sql = "SELECT 
            products.id AS product_id,
            products.name AS product_name,
            categories.name AS category_name,
            products.description,
            products.price,
            products.stock,
            MIN(product_images.image_url) AS image_url
        FROM 
            products
        INNER JOIN 
            categories ON products.category_id = categories.id
        LEFT JOIN 
            product_images ON products.id = product_images.product_id
        GROUP BY 
            products.id";

$result = mysqli_query($conn, $sql);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Product List</h2>
        <button class="createbtn" onclick="location.href='addproduct.php'">Create New Product</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Hiển thị từng dòng dữ liệu
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["category_name"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . number_format($row['price'], 0, ',', '.')."đ</td>";
                            echo "<td>" . $row["stock"] . "</td>";
                            echo "<td><img src='" . $row["image_url"] . "' alt='Product Image' width='50' height='70'></td>";
                            echo "<td>
                                    <button class='btn btn-primary' onclick=\"location.href='editproduct.php?id=" . $row["product_id"] . "'\">Edit</button>
                                    <button class='btn btn-danger' onclick=\"confirmDelete(" . $row["product_id"] . ")\">Delete</button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No products found</td></tr>";
                    }
                    ?>
                    <script>
                        function confirmDelete(productId) {
                            // Hiển thị hộp thoại xác nhận
                            var result = confirm("Are you sure you want to delete this product?");
                            if (result) {
                                // Nếu người dùng chọn "OK", chuyển hướng đến trang deleteproduct.php
                                location.href = 'deleteproduct.php?id=' + productId;
                            }
                            // Nếu người dùng chọn "Cancel", không làm gì cả
                        }
                    </script>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<?php
require_once('includes/footer.php');

?>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,          
            "lengthMenu": [5, 10, 25, 50, 100],  
            "pageLength": 5,         
            "searching": true,        
            "ordering": true,         
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>