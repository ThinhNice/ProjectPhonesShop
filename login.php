<?php
ob_start();
session_start();
if (isset($_SESSION['success_message-logout'])) {
    echo '<div id="toast" class="toast show">' . $_SESSION['success_message-logout'] . '</div>';
    unset($_SESSION['success_message-logout']); 
}
require_once("./nav.php");
require_once("./connect-sql.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Truy vấn dữ liệu bằng MySQLi
    $command = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($command);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $input_password == $user['password']) {
        $_SESSION['admin']['user_id'] = $user['id'];
        $_SESSION['admin']['username'] = $user['username'];
        $_SESSION['admin']['is_admin'] = true;      

        header('Location: ./admin/dashboard.php');
        exit();
    } else {
        $error_message = 'Invalid username or password'; 
    }
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./assets/css/register.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <div class="frame">
            <div class="admin-header">
                <p>Admin Login</p>
            </div>
            <div class="form-area">
                <form class="form-signin" action="" method="post">
                    <label for="username">User Name</label>
                    <input class="form-styling" type="text" name="username" required>
                    <label for="password">Password</label>
                    <input class="form-styling" type="password" name="password" required>
                    <button type="submit">Login</button> 
                </form>
                <?php if (isset($error_message)): ?> 
                    <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <div class="forgot">
                    <a href="#">Forgot password</a>
                </div>
            </div>
        </div>
    </div>
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
</body>
</html>

<?php
require_once("./footer.php");
?>
