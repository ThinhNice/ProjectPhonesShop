
<?php
require_once('./includes/admin-conect.php');

require_once("includes/header.php");
require_once("includes/conn.php");

$sql = "SELECT order_code AS 'Order ID', fullname AS 'Name', phone AS 'Phone', status AS 'Status', 
total_amount AS 'Total Price', received_address AS 'Address', 
payment_method AS 'Payment Method', created_at AS 'Order Date'
FROM orders";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order-list</title>

    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<script>
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 20, 50],
            "language": {
                "search": "Search Order code:",
                "searchPlaceholder": "Nhập code..."
            },
            "columnDefs": [{
                "targets": [1, 2, 4, 5, 6, 7, 8],
                "searchable": false
            }]
        });

        $('.nav-link').click(function () {
            var status = $(this).text().trim();

            if (status === "All") {
                table.column(3).search('').draw();
            } else {
                table.column(3).search('^' + status + '$', true, false).draw();
            }
        });
    });

</script>

<body>
    <div>
        <div class="card shadow border-0 mb-5 mt-3">
            <div class="card-header bg-white bg-gradient ml-0 py-3">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-primary">Orders list</h2>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row d-flex justify-content-between pb-4 pt-2">
                    <div class="col-md">
                        <ul class="nav nav-pills justify-content-start list-group list-group-horizontal-sm">
                            <li class="nav-item list-group-item"
                                style="border-bottom-left-radius:20px; border-top-left-radius:20px; padding: 0">
                                <a style="cursor: pointer;" class="nav-link bg-transparent px-3 pl-0">All</a>
                            </li>
                            <li class="nav-item list-group-item" style="padding: 0">
                                <a style="cursor: pointer;" class="nav-link bg-transparent px-3 pl-0">Đặt thành công</a>
                            </li>
                            <li class="nav-item list-group-item" style="padding: 0">
                                <a style="cursor: pointer;" class="nav-link bg-transparent px-3 pl-0">Đang vận
                                    chuyển</a>
                            </li>
                            <li class="nav-item list-group-item" style="padding: 0">
                                <a style="cursor: pointer;" class="nav-link bg-transparent px-3 pl-0">Đã nhận</a>
                            </li>
                            <li class="nav-item list-group-item"
                                style="border-bottom-right-radius:20px; border-top-right-radius:20px; padding: 0">
                                <a style="cursor: pointer;" class="nav-link bg-transparent px-3 pl-0">Hủy đơn</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <table id="dataTable" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order code</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Total price</th>
                            <th>Address</th>
                            <th>Payment method</th>
                            <th>Order date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['Order ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Phone']) . "</td>";
                                echo "<td>" . getStatus($row['Status']) . "</td>";
                                echo "<td>" . number_format($row['Total Price'], 0, ',', '.') . "đ</td>";
                                echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                                echo "<td>" . getPaymentMethod($row['Payment Method']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Order Date']) . "</td>";
                                echo '<td><a href="order_details.php?order_code=' . htmlspecialchars($row['Order ID']) . '" class="btn btn-sm btn-info">Edit</a></td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No orders found.</td></tr>";
                        }

                        function getPaymentMethod($paymentMethod)
                        {
                            return $paymentMethod == 0 ? 'Thanh toán khi nhận hàng' : htmlspecialchars($paymentMethod);
                        }
                        function getStatus($status)
                        {
                            switch ($status) {
                                case '0':
                                    return 'Đặt thành công';
                                case '1':
                                    return 'Đang vận chuyển';
                                case '2':
                                    return 'Đã nhận';
                                case '3':
                                    return 'Hủy đơn';
                                default:
                                    return 'Không rõ trạng thái';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php
require_once('includes/footer.php');
?>
