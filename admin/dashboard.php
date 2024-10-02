<?php   
require_once('./includes/admin-conect.php');
require('includes/header.php');
require('includes/statistic.php');
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>


<!-- Content Row -->
<div class="row">

    <!-- Earnings (Weekly) -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Earnings (Weekly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if(isset($wrow["total_revenue"])){
                                echo $wrow["total_revenue"]. " đ";
                            }else{
                                echo "0 đ";
                            }
                                ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly)  -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if(isset($mrow["total_revenue"])){
                                echo $mrow["total_revenue"] . " đ";
                                }else{
                                    echo "0 đ";
                                } 
                                ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Earnings (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if(isset($yrow["total_revenue"])){
                                echo $yrow["total_revenue"] . " đ";
                            }else{
                                    echo "0 đ";
                                } ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <!-- Area Chart -->
    <div style="width:100%">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Thong ke san pham ban chay -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Trending Product</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Best Sellers of the Week</th>
                        <th>Best Sellers of the Month</th>
                        <th>Best Sellers of the Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if (empty($bestSellingProductsWeek)) {
                            echo "<td>No product sold this week. </td>";
                        } else {
                            foreach ($bestSellingProductsWeek as $value) {
                                echo "<td>" . $value['product_name'] . "(" . $value['total_quantity_sold'] . " products)</td>";
                            }
                        }
                        if (empty($bestSellingProductsMonth)) {
                            echo "<td>No product sold this month. </td>";
                        } else {
                            foreach ($bestSellingProductsMonth as  $value) {
                                echo "<td>" . $value['product_name'] . "(" . $value['total_quantity_sold'] . " products)</td>";
                            }
                        }
                        if (empty($bestSellingProductsYear)) {
                            echo "<td>No product sold this year. </td>";
                        } else {
                            foreach ($bestSellingProductsYear as  $value) {
                                echo "<td>" . $value['product_name'] . "(" . $value['total_quantity_sold'] . " products)</td>";
                            }
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<?php
require('includes/footer.php');
?>