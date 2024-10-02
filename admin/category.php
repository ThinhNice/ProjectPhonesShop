<!-- End of Topbar -->
<?php
require_once('./includes/admin-conect.php');
require_once('includes/header.php');
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Category List</h2>
        <button class="createbtn" onclick="location.href='addcategory.php'">Create New Category</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'SELECT * FROM categories';
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        // Hiển thị từng dòng dữ liệu
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>
                                    <button class='btn btn-primary' onclick=\"location.href='editcategory.php?id=" . $row["id"] . "'\">Edit</button>
                                    <button class='btn btn-danger' onclick=\"confirmDelete(" . $row["id"] . ")\">Delete</button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No products found</td></tr>";
                    }
                    ?>
                    <script>
                        function confirmDelete(categoryId) {
                            // Hiển thị hộp thoại xác nhận
                            var result = confirm("Are you sure you want to delete this category?");
                            if (result) {
                                // Nếu người dùng chọn "OK", chuyển hướng đến trang deleteproduct.php
                                location.href = 'deletecategory.php?id=' + categoryId;
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
            "paging": true,          // Tính năng phân trang
            "lengthMenu": [5, 10, 25, 50, 100],  // Tùy chọn số lượng hàng hiển thị
            "pageLength": 5,         // Mặc định hiển thị 10 hàng
            "searching": true,        // Tính năng tìm kiếm
            "ordering": true,         // Tính năng sắp xếp cột
        });
    });
</script>