<?php
session_start();
require_once("./nav.php");
$is_cart_empty = empty($_SESSION['cart']) ;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <title>Cart</title>
</head>

<body>
    <section>
        <div class="container">
            <div class="title">
                <div class="row flex">
                    <div class="shopping-cart">
                        <h3>Your shopping cart</h3>
                    </div>
                    <div class="number-items">
                        <h5><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> items</h5>
                    </div>
                </div>
            </div>
            <div class="items">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="item flex">
                        <div class="product-image rounded">
                            <img src="<?php echo isset($item['first_image']) ? htmlspecialchars($item['first_image']) : 'default_image.jpg'; ?>" alt="">
                        </div>
                        <div class="product-info">
                            <div><?php echo htmlspecialchars($item['product_name']); ?></div>
                            <?php if (isset($item['product_id'])): ?>
                            <div>Product ID: <?php echo htmlspecialchars($item['product_id']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="add flex1">
                            <span class="minus cursor-pointer">-</span>
                            <label class="num"><?php echo htmlspecialchars($item['quantity']); ?></label>
                            <span class="plus cursor-pointer">+</span>
                        </div>
                        <div class="product-price" data-base-price="<?php echo htmlspecialchars($item['product_price']); ?>">
                            <?php echo number_format($item['total_price'], 0, ',', '.') . 'đ';?>
                        </div>
                        <div class="ignore-product">
                            <button type="button" class="btn btn-danger">Clear</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                <div class="item flex">
                    <div>Your cart is empty.</div>
                </div>
                <?php endif; ?>
            </div>
            <div class="button-groups flex2">
                <div class="back">
                    <button type="button">
                        <a class="btn-cart" href="./index">Back to home</a>
                    </button>
                </div>
                <div class="submit">
                    <button type="button" <?php echo $is_cart_empty ? 'disabled' : ''; ?> >
                        <?php if ($is_cart_empty): ?>
                            Check out
                        <?php else: ?>
                            <a class="btn-cart" href="./order.php">Check out</a>
                        <?php endif; ?>
                    </button>
                </div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carts = document.querySelector('.items');

            carts.addEventListener('click', function(event) {
                const target = event.target;

                if (target.classList.contains('plus')) {
                    const item = target.closest('.item');
                    const numLabel = item.querySelector('.num');
                    const productPrice = item.querySelector('.product-price');
                    const productName = item.querySelector('.product-info div').textContent; 
                    const basePrice = parseInt(productPrice.getAttribute('data-base-price')); 

                    let quantity = parseInt(numLabel.innerHTML);
                    quantity++;
                    numLabel.innerHTML = quantity;

                    const totalPrice = (basePrice * quantity).toLocaleString();
                    productPrice.innerHTML = totalPrice + 'đ';

                    updateCart(productName, 'increase', basePrice);
                }

                if (target.classList.contains('minus')) {
                    const item = target.closest('.item');
                    const numLabel = item.querySelector('.num');
                    const productPrice = item.querySelector('.product-price');
                    const productName = item.querySelector('.product-info div').textContent; 
                    const basePrice = parseInt(productPrice.getAttribute('data-base-price')); 

                    let quantity = parseInt(numLabel.innerHTML);
                    if (quantity > 1) {
                        quantity--;
                        numLabel.innerHTML = quantity;

                        const totalPrice = (basePrice * quantity).toLocaleString();
                        productPrice.innerHTML = totalPrice + 'đ';

                        updateCart(productName, 'decrease');
                    }
                }

                if (target.classList.contains('btn-danger')) {
                    const item = target.closest('.item');
                    const productName = item.querySelector('.product-info div').textContent; 
                    updateCart(productName, 'remove');
                    item.remove();
                    updateCartDisplay();
                }
            });
            function updateCartDisplay(){
                const itemCountElement = document.querySelector('.number-items h5');
                const cartItems = document.querySelectorAll('.items .item');
                const checkoutButton = document.querySelector('.submit button');
                itemCountElement.textContent = `${cartItems.length} items`;
                if (cartItems.length === 0 ) {
                    checkoutButton.disabled = true;
                    checkoutButton.textContent = 'Check out'; 
                }
                else {
                    checkoutButton.disabled = false;
                    checkoutButton.innerHTML = '<a class="btn-cart" href="./order.php">Check out</a>';
                }

            }
            function updateCart(productName, action, productPrice) {
                const data = new URLSearchParams();
                data.append('product_name', productName);
                data.append('action', action);
                if (productPrice) {
                    data.append('product_price', productPrice);
                }

                fetch('update-cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: data.toString()
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            console.log(`Cart updated: ${data.cart_count} items`);
                            updateCartDisplay();
                        }
                    })
                    .catch(error => console.error('Error updating cart:', error));
            }

        });
        </script>
    </section>
</body>

</html>

<?php
require_once('./footer.php');
?>
