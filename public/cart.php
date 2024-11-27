<?php
ob_start();
require_once __DIR__ . '/include/header.php';
?>
<?php
if (isset($_GET['delete_cart'])) {
    $cartId = $_GET['delete_cart'];
    $delete_cart = $cart->delete_cart($cartId);
    echo $delete_cart;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    $quantity = $_POST['quantity'];
    $cartId = $_POST['cartId'];
    $update_cart = $cart->update_cart($quantity, $cartId);
    echo $update_cart;
}
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </nav>

    <h2 class="text-center text-primary mb-4 font-weight-bold">Giỏ hàng của bạn</h2>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sessionId = session_id();
                    $get_cart = $cart->get_cart($sessionId);
                    if ($get_cart) {
                        $total_price = 0;
                        $vat = 0;
                        while ($result = $get_cart->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="align-middle"><strong><?php echo $result['productName']; ?></strong></td>
                                <td class="align-middle"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="Hình ảnh sản phẩm" class="img-thumbnail" style="width: 80px;"></td>
                                <td class="align-middle"><?php echo $fm->format_currency($result['productPrice']); ?></td>
                                <td class="align-middle">
                                    <form action="" method="post" class="d-flex align-items-center">
                                        <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>">
                                        <input type="number" class="form-control form-control-sm me-2" style="width: 70px;" name="quantity" min="1" value="<?php echo $result['quantity']; ?>">
                                        <button type="submit" class="btn btn-outline-primary btn-sm" name="update_cart">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle"><strong><?php echo $fm->format_currency($result['productPrice'] * $result['quantity']); ?></strong></td>
                                <td class="align-middle">
                                    <a href="cart.php?delete_cart=<?php echo $result['cartId']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?');" class="btn btn-outline-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $total_price += $result['productPrice'] * $result['quantity'];
                            $vat = $total_price * 0.1;
                            ?>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4 shadow">
        <div class="card-body">
            <?php
            $check_cart = $cart->check_cart();
            if ($check_cart) {
            ?>
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td>Tổng cộng:</td>
                                <td class="text-end"><strong><?php echo $fm->format_currency($total_price); ?></strong></td>
                            </tr>
                            <tr>
                                <td>VAT (10%):</td>
                                <td class="text-end"><strong><?php echo $fm->format_currency($vat); ?></strong></td>
                            </tr>
                            <tr class="border-top">
                                <td>
                                    <h4 class="mb-0">Tổng thanh toán:</h4>
                                </td>
                                <td class="text-end">
                                    <h4 class="text-danger mb-0"><?php echo $fm->format_currency($total_price + $vat); ?></h4>
                                </td>
                            </tr>
                        </table>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="index.php" class="btn btn-outline-secondary btn-lg me-md-2">
                                <i class="fa fa-arrow-left me-2"></i>Tiếp tục mua sắm
                            </a>
                            <a href="pay.php" class="btn btn-primary btn-lg">
                                Thanh toán<i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="text-center py-5">
                    <i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted mb-4">Giỏ hàng của bạn đang trống</h4>
                    <a href="index.php" class="btn btn-primary btn-lg">
                        <i class="fa fa-shopping-bag me-2"></i>Bắt đầu mua sắm
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/include/footer.php';
ob_end_flush();
?>