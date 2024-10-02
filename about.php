<?php
session_start();
require_once("./nav.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1 class="H-font">About Us</h1>
                    <p style="text-align: justify;">
                        Chào mừng bạn đến với Shop – điểm đến đáng tin cậy cho mọi nhu cầu về điện thoại và công nghệ di
                        động! Với nhiều năm kinh nghiệm trong ngành bán lẻ điện thoại, chúng tôi cam kết mang đến cho
                        khách hàng những sản phẩm chất lượng cao từ các thương hiệu hàng đầu thế giới. Tại Shop, sự hài
                        lòng của khách hàng luôn là ưu tiên hàng đầu. Chúng tôi không chỉ cung cấp sản phẩm tốt nhất mà
                        còn mang đến dịch vụ chăm sóc khách hàng tận tâm và chuyên nghiệp.
                    </p>
                </div>
                <div class="col-md-4">
                    <img class="w-100" src="./assets/img/img-about.png" alt="About Hero">
                </div>
            </div>
        </div>
    </section>

    <!-- Start Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Services</h1>
                <p style="text-align: justify;">
                    Chúng tôi cung cấp đa dạng các dịch vụ nhằm mang lại trải nghiệm mua sắm hoàn hảo cho khách hàng.
                    Bạn có thể tìm thấy các mẫu điện thoại mới nhất, cùng với những phụ kiện chính hãng như ốp lưng,
                    sạc, tai nghe và nhiều hơn nữa. Ngoài ra, chúng tôi còn có chính sách bảo hành rõ ràng, hỗ trợ kỹ
                    thuật và dịch vụ sửa chữa chuyên nghiệp, giúp khách hàng hoàn toàn yên tâm trong suốt quá trình sử
                    dụng sản phẩm. Với dịch vụ giao hàng nhanh chóng và tiện lợi, bạn có thể nhận được sản phẩm yêu
                    thích của mình trong thời gian ngắn nhất.
                </p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-truck"></i></div>
                    <h2 class="h5 mt-4 text-center">Delivery Services</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fas fa-exchange-alt"></i></div>
                    <h2 class="h5 mt-4 text-center">Shipping & Return</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-percent"></i></div>
                    <h2 class="h5 mt-4 text-center">Promotion</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-user"></i></div>
                    <h2 class="h5 mt-4 text-center">24 Hours Service</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Start Brands -->
    <section class=" py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Our Brands</h1>
                    <p style="text-align: justify;">
                        Shop tự hào là đối tác của các thương hiệu điện thoại hàng đầu như Apple, Samsung, Xiaomi, Oppo,
                        và nhiều hãng công nghệ khác. Chúng tôi luôn cập nhật những sản phẩm mới nhất từ các thương hiệu
                        này để mang đến cho khách hàng nhiều lựa chọn phong phú và hiện đại nhất. Mỗi sản phẩm đều được
                        chọn lọc kỹ lưỡng để đảm bảo chất lượng và sự an tâm cho khách hàng khi mua sắm tại cửa hàng của
                        chúng tôi.
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="pt-2 pt-md-0" id="templatemo-slide-brand">
                                <div class="product-links-wap" role="listbox">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img h-100"
                                                    src="./assets/img/nhan-apple.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img h-100"
                                                    src="./assets/img/logo-samsung1.avif" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img h-100"
                                                    src="./assets/img/logo-oppo1.jpg" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img h-100"
                                                    src="./assets/img/Xiaomi_logo_(2021-).svg" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
require_once("./footer.php");
?>