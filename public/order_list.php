<?php
ob_start();
require_once __DIR__ . '/include/header.php';
?>

<?php
if (isset($_GET['delete_order'])) {
    $orderId = $_GET['delete_order'];
    $delete_order = $cart->delete_order($orderId);
    echo $delete_order;
}
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đơn hàng đã đặt</li>
        </ol>
    </nav>
    <h2 class="text-center text-primary mb-4 font-weight-bold">Đơn hàng đã đặt</h2>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>Đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_cart_ordered = $cart->get_cart_ordered_by_customerId(Session::get("customerId"));
                    if ($get_cart_ordered) {
                        $i = 1;
                        while ($result = $get_cart_ordered->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="align-middle"><?php echo $i;
                                                            $i++; ?></td>
                                <td class="align-middle"><?php echo $fm->formatDate($result['orderDate']); ?></td>
                                <td class="align-middle">
                                    <?php if ($result['status'] == 0): ?>
                                        <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                    <?php elseif ($result['status'] == 1): ?>
                                        <span class="badge bg-success">Đã xác nhận</span>
                                    <?php elseif ($result['status'] == 2): ?>
                                        <span class="badge bg-info">Đang giao hàng</span>
                                    <?php elseif ($result['status'] == 3): ?>
                                        <span class="badge bg-success">Đã giao hàng</span>
                                    <?php elseif ($result['status'] == 4): ?>
                                        <span class="badge bg-danger">Đã hủy</span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <a href="order_detail.php?order_id=<?php echo $result['order_id']; ?>" class="btn btn-outline-primary btn-sm">
                                        Xem
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="order_list.php?delete_order=<?php echo $result['order_id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/include/footer.php';
ob_end_flush();
?>