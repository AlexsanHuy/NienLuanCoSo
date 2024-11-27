<?php
ob_start();
require_once __DIR__ . '/include/header.php';
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
        </ol>
    </nav>

    <h2 class="text-center text-primary mb-4 font-weight-bold">Chi tiết đơn hàng</h2>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
                    $get_cart_ordered = $cart->get_order_details($order_id);
                    if ($get_cart_ordered) {
                        $total_price = 0;
                        $vat = 0;
                        while ($result = $get_cart_ordered->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="align-middle"><strong><?php echo $result['productName']; ?></strong></td>
                                <td class="align-middle"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="Hình ảnh sản phẩm" class="img-thumbnail" style="width: 80px;"></td>
                                <td class="align-middle"><?php echo $fm->format_currency($result['price']); ?></td>
                                <td class="align-middle">
                                    <span style="width: 70px;"><?php echo $result['quantity']; ?></span>
                                </td>
                                <td class="align-middle"><strong><?php echo $fm->format_currency($result['price'] * $result['quantity']); ?></strong></td>
                            </tr>
                            <?php
                            $total_price += $result['price'];
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
                    </div>
                </div>
            </div>
        </div>
</div>

<?php
require_once __DIR__ . '/include/footer.php';
ob_end_flush();
?>