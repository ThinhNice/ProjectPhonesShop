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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>