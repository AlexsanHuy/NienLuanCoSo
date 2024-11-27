<?php
ob_start();
require_once __DIR__ . '/include/header.php';
$detailId = isset($_GET['productId']) ? $_GET['productId'] : null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_cart'])) {
    $quantity = $_POST['quantity'];
    $insert_cart = $cart->insert_cart($quantity, $detailId);
    echo $insert_cart;
}
?>

<body class="bg-light">
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
        </ol>
    </nav>
    <?php
    $detail_product = $product->get_detail_product($detailId);
    if ($detail_product && $result = $detail_product->fetch_assoc()) {
    ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body p-4">
                    <h2 class="card-title text-primary mb-4"><?php echo $result['productName']; ?></h2>
                    <hr class="my-4">
                    <div class="text-center mb-5">
                        <img src="admin/uploads/<?php echo $result['productImage']; ?>" class="img-fluid rounded shadow-sm" alt="<?php echo $result['productName']; ?>" style="width: 30%; height: auto;">
                    </div>
                    
                    <ul class="nav nav-pills mb-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="true">Thông số kỹ thuật</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="false">Bình luận</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr><th class="w-25">Màn hình:</th><td><?php echo $result['productScreen']; ?></td></tr>
                                    <tr><th>Camera sau:</th><td><?php echo $result['productCamera']; ?></td></tr>
                                    <tr><th>Camera trước:</th><td><?php echo $result['productFrontcamera']; ?></td></tr>
                                    <tr><th>Chip:</th><td><?php echo $result['productChip']; ?></td></tr>
                                    <tr><th>RAM:</th><td><?php echo $result['productRam']; ?></td></tr>
                                    <tr><th>Bộ nhớ trong:</th><td><?php echo $result['productRom']; ?></td></tr>
                                    <tr><th>Hệ điều hành:</th><td><?php echo $result['productOs']; ?></td></tr>
                                    <tr><th>Độ phân giải:</th><td><?php echo $result['productResolution']; ?></td></tr>
                                    <tr><th>NFC:</th><td><?php echo $result['productNfc'] == 1 ? "Có" : "Không"; ?></td></tr>
                                    <tr><th>Pin:</th><td><?php echo $result['productPin']; ?></td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                            <form action="#" method="post" class="mb-4">
                                <div class="mb-3">
                                    <label for="feedback" class="form-label">Bình luận:</label>
                                    <textarea class="form-control" id="feedback" rows="4" placeholder="Viết bình luận của bạn"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-lg h-100 border-0">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">Tùy chọn sản phẩm</h3>
                    <div class="mb-4">
                        <h6 class="mb-3">Chọn dung lượng:</h6>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="capacity" id="cap64" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="cap64">64GB</label>
                            <input type="radio" class="btn-check" name="capacity" id="cap128" autocomplete="off">
                            <label class="btn btn-outline-primary" for="cap128">128GB</label>
                            <input type="radio" class="btn-check" name="capacity" id="cap256" autocomplete="off">
                            <label class="btn btn-outline-primary" for="cap256">256GB</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-3">Chọn màu:</h6>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary rounded-circle p-3" style="background-color: #000;"></button>
                            <button class="btn btn-outline-secondary rounded-circle p-3" style="background-color: #fff;"></button>
                            <button class="btn btn-outline-secondary rounded-circle p-3" style="background-color: #007bff;"></button>
                            <button class="btn btn-outline-secondary rounded-circle p-3" style="background-color: #28a745;"></button>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h3 class="text-danger mb-4"><?php echo $fm->format_currency($result['productPrice']); ?></h3>
                    <form action="" method="post" class="mb-4">
                        <div class="input-group">
                            <input type="number" class="form-control" value="1" min="1" name="quantity">
                            <button type="submit" class="btn btn-primary" name="add_cart"><i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                    <div class="d-grid gap-3">
                        <button type="button" class="btn btn-outline-secondary"><i class="fas fa-exchange-alt me-2"></i>So sánh</button>
                        <button type="button" class="btn btn-dark"><i class="fas fa-credit-card me-2"></i>Trả góp 0%</button>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <a href="#" class="text-decoration-none">Đánh giá sản phẩm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
</body>

<?php
require_once __DIR__ . '/include/footer.php';
ob_end_flush();
?>