<?php
ob_start();
require_once __DIR__ . '/include/header.php';
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
        </ol>
    </nav>

    <h2 class="text-center text-primary mb-4 font-weight-bold">Thông tin cá nhân</h2>

    <?php
    if (isset($update_cart)) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                ' . $update_cart . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>

    <div class="card shadow text-center">
        <div class="card-body">
            <?php
            $customerName = Session::get('customerName');
            $customerUsername = Session::get('customerUsername');
            $customerEmail = Session::get('customerEmail');
            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <i class="fa fa-user me-2"></i>
                    <strong>Họ và tên:</strong> <?php echo $customerName; ?>
                </li>
                <li class="list-group-item">
                    <i class="fa fa-id-badge me-2"></i>
                    <strong>Tên đăng nhập:</strong> <?php echo $customerUsername; ?>
                </li>
                <li class="list-group-item">
                    <i class="fa fa-envelope me-2"></i>
                    <strong>Email:</strong> <?php echo $customerEmail; ?>
                </li>
            </ul>
        </div>
    </div>

    </div>
</div>

<?php
require_once __DIR__ . '/include/footer.php';
ob_end_flush();
?>