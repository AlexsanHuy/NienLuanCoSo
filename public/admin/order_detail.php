<?php
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/../../classes/cart.php";
require_once __DIR__ . "/../../config/format.php";
$fm = new format();
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-12">
                <div class="bg-secondary-subtle p-3 rounded">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            Chức năng
                        </a>
                        <a href="addcategory.php" class="list-group-item list-group-item-action">Thêm thương hiệu</a>
                        <a href="catlist.php" class="list-group-item list-group-item-action">Danh sách thương hiệu</a>
                        <a href="addproduct.php" class="list-group-item list-group-item-action">Thêm sản phẩm</a>
                        <a href="listproduct.php" class="list-group-item list-group-item-action">Danh sách sản phẩm</a>
                        <a href="order.php" class="list-group-item list-group-item-action">Quản lý đơn hàng</a>
                        <a href="listuser.php" class="list-group-item list-group-item-action">Quản lý TK người dùng</a>
                        <a href="comment.php" class="list-group-item list-group-item-action">Quản lý bình luận</a>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-sm-12">
                <div class="bg-secondary-subtle p-3 rounded h-100">
                    <h4 class="text-center">Thông tin đơn hàng</h4>
                    <hr>
                    <table class="table text-center">
                        <thead>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                        </thead>
                        <tbody>
                            <?php
                            $cart = new cart();
                            $orderId = $_GET['order_id'];
                            $get_order_details = $cart->get_order_details($orderId);
                            $total_price = 0;
                            $vat = 0;
                            if ($get_order_details) {
                                $i = 1;
                                while ($result = $get_order_details->fetch_assoc()) {
                                    $total_price += $result['price'];
                                    $vat = $total_price * 0.1;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $result['productName']; ?></td>
                                        <td><?php echo $result['price']; ?></td>
                                        <td><?php echo $result['quantity']; ?></td>
                                        <td><?php echo $fm->format_currency($result['price'] * $result['quantity']); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                $get_info_order = $cart->get_info_order($orderId);
                                if ($get_info_order) {
                                    $result = $get_info_order->fetch_assoc();
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <table class="text-start">
                                                <tr>
                                                    <th>Tên khách hàng:</th>
                                                    <td><?php echo $result['customerName']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Số điện thoại:</th>
                                                    <td><?php echo $result['customerPhone']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Địa chỉ:</th>
                                                    <td><?php echo $result['customerAdd']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Phương thức thanh toán:</th>
                                                    <td><?php echo $result['paymentMethod']; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td colspan="3" style="text-align: right;">
                                            Tổng cộng: <?php echo $fm->format_currency($total_price); ?><br>
                                            VAT: <?php echo $fm->format_currency($vat); ?><br>
                                            Thanh toán: <?php echo $fm->format_currency($total_price + $vat); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <a href="order.php" class="btn btn-primary">Quay lại</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>Không có dữ liệu đơn hàng</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once __DIR__ . "/include/footer.php";
?>

</html>