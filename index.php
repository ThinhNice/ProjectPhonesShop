<?php
session_start();

if (isset($_SESSION['success_message'])) {
    echo '<div id="toast" class="toast show">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); 
}
require_once("./connect-sql.php");

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$sql1 = "SELECT id, name FROM categories";
$result1 = $conn->query($sql1);

$products_by_category = [];

$sql3 = "SELECT 
            products.id AS product_id, 
            products.name AS product_name, 
            products.description, 
            products.price, 
            categories.id AS category_id, 
            categories.name AS category_name, 
            MIN(product_images.image_url) AS image_url
        FROM products
        INNER JOIN categories ON products.category_id = categories.id
        LEFT JOIN product_images ON products.id = product_images.product_id
        WHERE products.name LIKE ?
        GROUP BY products.id, categories.id";

$stmt = $conn->prepare($sql3);
$searchTermPrepared = "%" . $searchTerm . "%"; 
$stmt->bind_param('s', $searchTermPrepared);
$stmt->execute();
$result3 = $stmt->get_result();

if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $category_id = $row['category_id'];
        $products_by_category[$category_id][] = $row;
    }
}
$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
</head>

<body>
    <!-- Nav start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid ">
            <a class="navbar-brand me-5 fw-bold fs-2 H-font" href="./index.php">PHONES STORE</a>
            <button class="navbar-toggler shadow-non" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2" aria-current="page" href="./index.php">HOME</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="./about.php">ABOUT</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="./contact.php">CONTACT</a>
                    </li>  
                    <li class="nav-item me-2">
                        <a class="nav-link" href="./carts.php">
                            CART
                            <i class="bi bi-cart2"></i>
                        </a>
                    </li>
                    <!-- Hiển thị Dashboard nếu admin đã đăng nhập -->
                    <?php if (isset($_SESSION['admin']["is_admin"])): ?>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="./admin/dashboard.php">DASHBOARD</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex me-5 icon-user-flex">
                    <div class="nav-item dropdown">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle icon_user"></i>
                            <?php if (isset($_SESSION['admin']["is_admin"])) 
                                echo '<span class="text-dark">Admin</span>'
                            ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./login.php">
                                    <i class="bi bi-box-arrow-in-right "></i>
                                    <span class="dropdown-title">Login </span>
                                </a></li>
                            <li><a class="dropdown-item" href="./order-list.php">
                                    <i class="bi bi-suitcase-lg "></i>
                                    <span class="dropdown-title">My order</span>
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./logout.php">
                                    <i class="bi bi-box-arrow-left "></i>
                                    <span class="dropdown-title">Log out</span>
                                </a></li>
                        </ul>
                    </div>
                </form>

            </div>
        </div>
    </nav>
    <!-- Nav end -->
    <!-- Header body start -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-8">
                <img class="background-header"
                    src="https://cdnphoto.dantri.com.vn/yuEwqwZ7nrVUhJEaU86pJNE4ZMQ=/thumb_w/1020/2024/09/10/iphone-16-pro-max-1725909527658.jpg"
                    alt="">
            </div>
            <div class="col-sm-4">
                <!-- <h3 class="bg-gradient bg-danger text-white d-inline-block rounded title_hot">Sản phẩm hot</h3> -->
                <img class="hot-item" src="./assets/img/hot-item.avif" alt="">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="./assets/img/iphone_16.png" class="img-fluid w-100 bg-secondary rounded"
                                alt="First slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">HOT</a>
                        </div>
                        <div class="carousel-item rounded">
                            <img src="./assets/img/iphone_16_2.jpg" class="img-fluid w-100 rounded" alt="Second slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">NEW</a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <img class="img-tmp" src="./assets/img/cam-ket-chat-luong-san-pham.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Header body end -->

    <!-- Product -->

    <div id="search-section" class="container-fluid phones-product py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Our Phones</h1>
                        <form method="GET" action="#search-section">
                            <div class="input-group">
                                <input id="search-product" name="search"
                                    class="form-control border-2 border-secondary py-3 px-2 rounded-pill" type="text"
                                    placeholder="Search product" value="<?php echo htmlspecialchars($searchTerm); ?>">
                                <button type="submit" class="btn btn-primary rounded-pill px-4"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8 text-end titlte_product">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active text-decoration-none"
                                    data-bs-toggle="pill" href="#tab-0">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <?php
                        $categories = []; 
                        if ($result1->num_rows > 0) {
                            while($row = $result1->fetch_assoc()) {
                                $categories[$row['id']] = $row['name']; 
                                echo '<li class="nav-item">';
                                echo '<a class="d-flex m-2 py-2 bg-light rounded-pill text-decoration-none" data-bs-toggle="pill" href="#tab-'.$row['id'].'">';
                                echo '<span class="text-dark" style="width: 130px;">' . htmlspecialchars($row['name']) . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                        } else {
                            echo "Không có danh mục nào!";
                        }
                        ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <!-- Tab cho tất cả sản phẩm -->
                    <div id="tab-0" class="tab-pane fade show p-0 active">
                        <?php
                    if (!empty($products_by_category)) {
                        echo '<div id="product-list" class="row g-4">';
                        foreach ($products_by_category as $category_products) {
                            foreach ($category_products as $product) {
                                $image_url = !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : './assets/img/default.png';
                                echo '<div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative product-item">
                                        <div class="product-img">
                                            <img src="'.$image_url.'" class="img-fluid w-100 rounded-top" alt="'.htmlspecialchars($product['product_name']).'">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">'.htmlspecialchars($product['category_name']).'</div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom product-tmp">
                                            <h4 style="font-size:1.3rem;">'.htmlspecialchars($product['product_name']).'</h4>
                                            <p class="text-truncate-3" style="text-align:justify;">'. strip_tags($product['description']).'</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">'.number_format($product['price'], 0, ',', '.').'đ</p>
                                                <a href="products-details-v2.php?product_id='.htmlspecialchars($product['product_id']).'" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>ADD</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                        echo '</div>';
                    } else {
                        echo "Không có sản phẩm nào!";
                    }
                    ?>
                    </div>

                    <!-- Tab cho từng danh mục -->
                    <?php
                    foreach ($categories as $category_id => $category_name) {
                        echo '<div id="tab-'.$category_id.'" class="tab-pane fade p-0">';
                        if (isset($products_by_category[$category_id])) {
                            echo '<div class="row g-4">';
                            foreach ($products_by_category[$category_id] as $product) {
                                $image_url = !empty($product['image_url']) ? htmlspecialchars($product['image_url']) : './assets/img/default.png';
                                echo '<div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative product-item">
                                        <div class="product-img">
                                            <img src="'.$image_url.'" class="img-fluid w-100 rounded-top" alt="'.htmlspecialchars($product['product_name']).'">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">'.htmlspecialchars($product['category_name']).'</div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom product-tmp">
                                            <h4>'.htmlspecialchars($product['product_name']).'</h4>
                                            <p class="text-truncate-3" style="text-align:justify;">'. strip_tags($product['description']).'</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">'.number_format($product['price'], 0, ',', '.').'đ</p>
                                                <a href="products-details-v2.php?product_id='.htmlspecialchars($product['product_id']).'" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>ADD</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                            echo '</div>';
                        } else {
                            echo "Không có sản phẩm nào trong danh mục này!";
                        }
                        echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Product end -->

    <!-- Reach us start -->
    <h2 class="mt-5 pt4 mb-4 text-center fw-bold H-font">Reach us</h2>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-8 bg-white rounded">
                <iframe class="w-100 rounded" height="320px"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.901067898686!2d105.78152807444914!3d20.996602488883784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x650f433062f3272b%3A0xc8198a797fd796e3!2sBekisoft%20JSC!5e0!3m2!1svi!2s!4v1726909695081!5m2!1svi!2s"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-sm-4 ">
                <div class="bg-white p-3 rounded mb-4">
                    <h5>Call us</h5>
                    <a href="tel: +84869615193" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +84869615193
                    </a>
                </div>
                <div class="bg-white p-3 rounded mb-4">
                    <h5>Follow us</h5>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-twitter me-1"></i> Twitter
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <!-- Reach us end -->

    <!-- Footer -->
    <div class="container-fluid bg-white mt-5">
        <div class="row row-footer">
            <div class="col-lg-4 p-4">
                <h3 class="H-font fw-bold fs-3 mb-2">Phones</h3>
                <p>
                    &copy; 2024 Cửa Hàng Điện Thoại - Chuyên cung cấp các dòng điện thoại chính hãng, chất lượng
                    với giá cả hợp lý.
                    <br>
                    Uy tín - Tận tâm - Chuyên nghiệp.
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Links</h5>
                <a href="./index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
                <a href="./about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a> <br>
                <a href="./contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact</a> <br>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Follow us</h5>
                <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                    <i class="bi bi-twitter me-1"> Twitter</i>
                </a> <br>
                <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                    <i class="bi bi-facebook me-1"> Facebook</i>
                </a> <br>
                <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                    <i class="bi bi-instagram me-1"> Instagram</i>
                </a> <br>
            </div>
        </div>

    </div>
    <h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by TTS BEKI SOFT</h6>
    <!-- Footer end -->
    <script>
    window.onload = function() {
        var toast = document.getElementById("toast");
        if (toast) {
            setTimeout(function() {
                toast.classList.remove("show");
            }, 2000);
        }
    };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
$conn->close();
?>