<?php
ob_start();
require_once __DIR__ . '/include/header.php';
?>
<script src="/js/index.js"></script>

<?php
if (Session::get("login") == false) {
    echo "<script>window.location.href = 'cart.php'; swal('Error!', 'Bạn phải đăng nhập để thanh toán', 'error');</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])) {
    $data = $_POST;
    $insertOrder = $cart->insertOrder($data);
    $del_cart = $cart->del_cart_logout();
    header("Location: order_list.php");
    exit();
}
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="cart.php" class="text-decoration-none text-primary">Giỏ hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
        </ol>
    </nav>

    <h2 class="text-center text-primary mb-4 font-weight-bold">Thanh toán</h2>
    <div class="row">
        <div class="col-7">
            <div class="card shadow-lg mb-4 border-0 rounded-lg">
                <div class="card-body p-4">
                    <h4 class="mb-2 text-primary text-center">Thông tin thanh toán</h4>
                    <form method="post">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control form-control-lg" id="fullName" name="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control form-control-lg" id="address" name="address" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control form-control-lg" id="phone" name="phone" required>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-3 text-primary">Phương thức thanh toán</h4>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">
                                <i class="fas fa-money-bill-wave me-2"></i>Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="bank" value="bank">
                            <label class="form-check-label" for="bank">
                                <i class="fas fa-university me-2"></i>Chuyển khoản ngân hàng
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-3" name="order"><i class="fas fa-check me-2"></i>Đặt hàng</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-4">
                    <h4 class="mb-3 text-primary text-center">Đơn hàng của bạn</h4>
                    <?php
                    $sessionId = session_id();
                    $get_cart = $cart->get_cart($sessionId);
                    if ($get_cart) {
                        $total_price = 0;
                        $vat = 0;
                        while ($result = $get_cart->fetch_assoc()) {
                            $total_price += $result['productPrice'] * $result['quantity'];
                        }
                        $vat = $total_price * 0.1;
                    ?>
                        <div class="list-group mb-3">
                            <?php
                            $get_cart = $cart->get_cart($sessionId);
                            if ($get_cart) {
                                $count = 1;
                                while ($result = $get_cart->fetch_assoc()) {
                            ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center lh-sm">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary rounded-pill me-3"><?php echo $count; ?></span>
                                            <img src="admin/uploads/<?php echo $result['image']; ?>" alt="<?php echo $result['productName']; ?>" class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="my-0"><?php echo $result['productName']; ?></h6>
                                                <small class="text-muted">Số lượng: <?php echo $result['quantity']; ?></small>
                                            </div>
                                        </div>
                                        <span class="fw-bold"><?php echo $fm->format_currency($result['productPrice'] * $result['quantity']); ?></span>
                                    </div>
                            <?php
                                    $count++;
                                }
                            }
                            ?>
                        </div>
                        <ul class="list-group mb-3">
                            <li class="list-group-item text-end">
                                <span>Tổng cộng: </span>
                                <strong><?php echo $fm->format_currency($total_price); ?></strong>
                            </li>
                            <li class="list-group-item text-end">
                                <span>VAT (10%): </span>
                                <strong><?php echo $fm->format_currency($vat); ?></strong>
                            </li>
                            <li class="list-group-item text-end">
                                <span class="text-primary">Tổng thanh toán: </span>
                                <strong class="text-danger"><?php echo $fm->format_currency($total_price + $vat); ?></strong>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Giỏ hàng của bạn đang trống</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/include/footer.php';
ob_end_flush();
?>