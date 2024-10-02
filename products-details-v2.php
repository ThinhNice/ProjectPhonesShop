<?php
ob_start();
session_start();
require_once("./nav.php");
require_once("./connect-sql.php");

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $command = "SELECT p.name, p.price, p.description, pi.image_url
                FROM products p
                JOIN product_images pi ON p.id = pi.product_id
                WHERE p.id = ?";
    
    if ($stmt = $conn->prepare($command)) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $product = $result->fetch_all(MYSQLI_ASSOC);

        if ($product) {
            $product_name = $product[0]['name'];
            $product_price = floatval($product[0]['price']); 
            $product_description = $product[0]['description'];
            $product_images = array_column($product, 'image_url');
        } else {
            echo 'No product found';
            exit; 
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo 'Product ID is not found';
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $first_image = isset($product_images[0]) ? $product_images[0] : 'default url';

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_name'] == $product_name) { 
            $item['quantity'] += $quantity; 
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'product_name' => $product_name,
            'quantity' => $quantity,
            'first_image' => $first_image,
            'product_price' => $product_price,
            'total_price' => $product_price * $quantity 
        ];
    } else {
        $item['total_price'] = $item['product_price'] * $item['quantity'];
    }

    $_SESSION['success_message'] = "Product added to your cart successfully!";
    
    header("location:./index.php");
    
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/products-details.css">
</head>

<body>
    <section>
        <div class="container flex">
            <div class="left">
                <div class="main-image">
                    <?php if (!empty($product_images)): ?>
                    <img src="<?php echo $product_images[0]; ?>" alt="Product Image" class="slide">
                    <?php else: ?>
                    <img src="default images url" alt="No images found" class="slide">
                    <?php endif; ?>
                    <div class="option-images flex">
                        <?php foreach ($product_images as $image): ?>
                        <img src="<?php echo $image; ?>" alt="Product image">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="right">
                <h3><?php echo htmlspecialchars($product_name); ?></h3>
                <h4><?php echo number_format($product_price, 0, ',', '.') . 'đ'; ?></h4>
                <p><?php echo strip_tags($product_description); ?></p>
                <h5>Color - Rose Gold</h5>
                <div class="colors flex1">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <h5>Quantity</h5>
                <form method="POST">
                    <div class="addItem flex1">
                        <span class="minus cursor-pointer">-</span>
                        <label class="num">1</label> 
                        <span class="plus cursor-pointer">+</span>
                        <input type="hidden" name="quantity" value="1" id="quantityInput">
                    </div>
                    <button type="submit">Add to your cart</button>
                </form>
            </div>
        </div>
    </section>

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

    <script>
    let num = document.querySelector('.num');
    let plus = document.querySelector('.plus');
    let minus = document.querySelector('.minus');
    let quantityInput = document.getElementById('quantityInput');
    let a = 1; 

    plus.addEventListener('click', () => {
        a++; 
        num.innerHTML = a; 
        quantityInput.value = a; 
    });

    minus.addEventListener('click', () => {
        if (a > 1) {
            a--; 
            num.innerHTML = a; 
            quantityInput.value = a; 
        }
    });
    </script>

</body>

</html>
