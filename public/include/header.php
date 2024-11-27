<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../config/format.php";

Session::init();
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/../../classes/" . $class . ".php";
});
$db = new Database();
$fm = new Format();
$cart = new cart();
$user = new user();
$product = new product();
$category = new category();
$cs = new customer();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $insertCustomer = $cs->insert_customer($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $loginCustomer = $cs->login_customer($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bffd8e0555.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="/../../images/logo.jpeg">
    <link rel="stylesheet" href="/../../css/style.css">
    <script src="/../../js/index.js"></script>
</head>

<header>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #1a2a3a;">
            <div class="container-fluid">
                <h2 class="text-white ms-5 logo-1"><a class="text-white logo-link text-decoration-none" href="index.php">Thegioibatdong.com</a></h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="nav d-flex align-items-center">
                    <form class="d-flex me-3 mt-3" action="search.php" method="get">
                        <input class="form-control me-2 rounded-pill" type="text" placeholder="Tìm kiếm" name="searchValue">
                        <button class="btn btn-outline-info rounded-circle" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <?php
                    if (Session::get("login") == true) {
                        echo '<li class="nav-item dropdown me-3 mt-1">
                        <a class="nav-link dropdown-toggle text-info" data-bs-toggle="dropdown" href="#">
                            <i class="fa fa-user-circle text-white"></i> ' . Session::get("customerUsername") . '
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-success" href="profile.php"><i class="fa fa-user me-2"></i>Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item text-danger" href="order_list.php"><i class="fa fa-shopping-cart me-2"></i>Đơn hàng</a></li>
                            <li><a class="dropdown-item text-primary" href="?customer_id=' . Session::get("customerId") . '"><i class="fa fa-sign-out me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </li>';
                    } else {
                        echo '<li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle text-info" data-bs-toggle="dropdown" href="#">
                            <i class="fa fa-user-circle text-white"></i> Tài khoản
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-primary" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-sign-in me-2"></i>Đăng nhập</a></li>
                            <li><a class="dropdown-item text-success" href="#" data-bs-toggle="modal" data-bs-target="#signupModal"><i class="fa fa-user-plus me-2"></i>Đăng ký</a></li>
                        </ul>
                    </li>';
                    }
                    ?>
                    <li class="nav-item">
                        <a class="btn btn-success rounded-pill" href="cart.php">
                            <i class="fa fa-shopping-cart me-2"></i>Giỏ hàng
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
        if (isset($_GET['customer_id'])) {
            $del_cart = $cart->del_cart_logout();
            session_destroy();
            header("Location: index.php");
            exit();
        }
        ?>

        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header text-white border-0">
                        <h5 class="modal-title fw-bold text-center w-100" id="loginModalLabel">Đăng nhập</h5>
                        <?php
                        if (isset($loginCustomer)) {
                            echo $loginCustomer;
                        }
                        ?>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form method="post">
                            <div class="mb-4">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="customerUsername" placeholder="Nhập tên đăng nhập">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="customerPassword" placeholder="Nhập mật khẩu">
                                </div>
                            </div>
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-4" name="login">Đăng nhập</button>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-danger w-48">
                                    <i class="fab fa-google me-2"></i>Google
                                </button>
                                <button type="button" class="btn btn-outline-primary w-48">
                                    <i class="fab fa-facebook-f me-2"></i>Facebook
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p class="text-center w-100 mb-0">Chưa có tài khoản? <a href="#" class="fw-bold" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header text-white border-0">
                        <h5 class="modal-title fw-bold text-center w-100" id="signupModalLabel">Đăng ký</h5>
                        <?php
                        if (isset($insertCustomer)) {
                            echo $insertCustomer;
                        }
                        ?>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form method="post">
                            <div class="mb-4">
                                <label for="signuName" class="form-label">Họ và tên</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" id="signuName" name="customerName" placeholder="Nhập họ và tên">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="signupUsername" class="form-label">Tên đăng nhập</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" id="signupUsername" name="customerUsername" placeholder="Nhập tên đăng nhập">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="signupEmail" class="form-label">Email</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="signupEmail" name="customerEmail" placeholder="Nhập email">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="signupPassword" class="form-label">Mật khẩu</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" id="signupPassword" name="customerPassword" placeholder="Nhập mật khẩu">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="signupConfirmPassword" class="form-label">Xác nhận mật khẩu</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" id="signupConfirmPassword" name="customerConfirmPassword" placeholder="Xác nhận mật khẩu">
                                </div>
                            </div>
                            <button type="submit" name="signup" class="btn btn-primary w-100">Đăng ký</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p class="text-center w-100 mb-0">Đã có tài khoản? <a href="#" class="fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Đăng nhập ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
</header>