<?php
require_once("conn.php");
?>
<?php
// Xu li phan Earning hang tuan
$wsql = "SELECT 
            FORMAT(SUM(total_amount),0) AS total_revenue
            FROM orders
            WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)
            AND status='2';";
$wresult = mysqli_query($conn, $wsql);
if ($wresult) {
$wrow = mysqli_fetch_array($wresult);
};
// Xu ly phan Earning hang thang
$msql = "SELECT 
            FORMAT(SUM(total_amount),0) AS total_revenue
            FROM orders
            WHERE MONTH(created_at) = MONTH(CURDATE())
            AND YEAR(created_at) = YEAR(CURDATE())
            AND status='2';"
    ;
$mresult = mysqli_query($conn, $msql);
if ($mresult) {
$mrow = mysqli_fetch_array($mresult);
};
// Xu ly phan Earning hang nam
$ysql = "SELECT 
            FORMAT(SUM(total_amount),0) AS total_revenue
            FROM orders
            WHERE YEAR(created_at) = YEAR(CURDATE())
            AND status='2';";
$yresult = mysqli_query($conn, $ysql);
if ($yresult) {
$yrow = mysqli_fetch_array($yresult);
};
// Xu ly du lieu phan line chart
$linesql = "SELECT 
                MONTH(created_at) AS month,
                SUM(total_amount) AS total_revenue
                FROM orders
                WHERE YEAR(created_at) = 2024
                AND status='2'
                GROUP BY MONTH(created_at)
                ORDER BY month;";

$lineresult = mysqli_query($conn, $linesql);

// Khoi tao mang de chua doanh thu cho 12 thang
$monthly_revenue = array_fill(1, 12, 0);

// Lặp qua các dòng kết quả
while ($linerow = mysqli_fetch_array($lineresult)) {
    $month = $linerow['month'];
    $total_revenue = $linerow['total_revenue'];

    // Gán doanh thu vào mảng theo tháng
    $monthly_revenue[$month] = $total_revenue;
}
?>
<script>
    // Chuyển đổi mảng PHP thành mảng JavaScript
    var monthlyRevenue = <?php echo json_encode(array_values($monthly_revenue)); ?>;
</script>

<!-- Xu li du lieu ve san pham ban chay theo tuan,thang,nam -->
<?php
$wprosql = 'SELECT 
                od.cur_pr_name AS product_name,
                SUM(od.quantity) AS total_quantity_sold
                FROM order_details od
                JOIN orders o ON od.order_id = o.id
                WHERE YEARWEEK(o.created_at, 1) = YEARWEEK(CURDATE(), 1)  
                AND o.status = "2"
                GROUP BY od.cur_pr_name
                ORDER BY total_quantity_sold DESC
                LIMIT 1;';
                
 
 $result_week = mysqli_query($conn,$wprosql);
 $bestSellingProductsWeek = [];
 if ($result_week) {
    if (mysqli_num_rows($result_week) > 0) {
        while($row = mysqli_fetch_assoc($result_week)) {
            $bestSellingProductsWeek[] = $row;
        }
    }
 };
$mprosql = 'SELECT 
                od.cur_pr_name AS product_name,
                SUM(od.quantity) AS total_quantity_sold
                FROM order_details od
                JOIN orders o ON od.order_id = o.id
                WHERE MONTH(o.created_at) = MONTH(CURDATE()) AND YEAR(o.created_at) = YEAR(CURDATE()) AND o.status="2"
                GROUP BY od.cur_pr_name
                ORDER BY total_quantity_sold DESC
                LIMIT 1;
';

$result_month = mysqli_query($conn,$mprosql);
$bestSellingProductsMonth = [];
if($result_month){
    if (mysqli_num_rows( $result_month) > 0) {
        while($row = mysqli_fetch_assoc($result_month)) {
            $bestSellingProductsMonth[] = $row;
        }
    }
};
$yprosql = 'SELECT 
                od.cur_pr_name AS product_name,
                SUM(od.quantity) AS total_quantity_sold
                FROM order_details od
                JOIN orders o ON od.order_id = o.id
                WHERE YEAR(o.created_at) = YEAR(CURDATE()) AND o.status="2"
                GROUP BY od.cur_pr_name
                ORDER BY total_quantity_sold DESC
                LIMIT 1;
';
$result_year = mysqli_query($conn,$yprosql);
$bestSellingProductsYear = [];
if ($result_year) {
    if ((mysqli_num_rows($result_year)> 0)) {
        while($row = mysqli_fetch_assoc($result_year)) {
            $bestSellingProductsYear[] = $row;
        }
    }
};