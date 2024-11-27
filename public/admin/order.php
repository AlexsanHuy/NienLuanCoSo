<?php
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/../../classes/cart.php";
require_once __DIR__ . "/../../config/format.php";
?>

<?php
$fm = new format();
$cart = new cart();
if (isset($_GET['delete_order'])) {
    $orderId = $_GET['delete_order'];
    $delete_order = $cart->delete_order($orderId);
    echo $delete_order;
}

if (isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];
    $update_status = $cart->update_status($orderId, $status);
    echo $update_status;
}

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
                    <h4 class="text-center">Quản lý đơn hàng</h4>
                    <hr>
                    <table class="table text-center">
                        <thead>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Trạng thái</th>
                            <th>Duyệt đơn</th>
                            <th>Ngày đặt</th>
                            <th>Chi tiết</th>
                            <th>Xóa</th>
                        </thead>
                        <?php
                        $show_order = $cart->get_cart_ordered();
                        if ($show_order) {
                            $i = 1;
                            while ($result = $show_order->fetch_assoc()) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td><?php echo $result['customerName']; ?></td>
                                        <td><?php if ($result['status'] == 0) {
                                                echo "<span class='badge bg-warning text-dark'>Chờ xác nhận</span>";
                                            } else if ($result['status'] == 1) {
                                                echo "<span class='badge bg-success'>Đã xác nhận</span>";
                                            } else if ($result['status'] == 2) {
                                                echo "<span class='badge bg-info'>Đang giao hàng</span>";
                                            } else if ($result['status'] == 3) {
                                                echo "<span class='badge bg-primary'>Đã giao hàng</span>";
                                            } else if ($result['status'] == 4) {
                                                echo "<span class='badge bg-danger'>Đã hủy</span>";
                                            } ?></td>
                                        <td>
                                            <form method="post" class="d-flex justify-content-between">
                                                <select name="status" id="status" class="form-select me-2">
                                                    <option value="0" class="text-warning">Chờ xác nhận</option>
                                                    <option value="1" class="text-success">Đã xác nhận</option>
                                                    <option value="2" class="text-info">Đang giao hàng</option>
                                                    <option value="3" class="text-primary">Đã giao hàng</option>
                                                    <option value="4" class="text-danger">Đã hủy</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary" name="update_status">OK</button>
                                                <input type="hidden" name="order_id" value="<?php echo $result['order_id']; ?>">
                                            </form>
                                        </td>
                                        <td><?php echo $fm->formatDate($result['orderDate']); ?></td>
                                        <td><a href="order_detail.php?order_id=<?php echo $result['order_id']; ?>">Xem</a></td>
                                        <td><a href="order.php?delete_order=<?php echo $result['order_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                            <?php
                            }
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