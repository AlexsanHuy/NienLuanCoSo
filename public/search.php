<?php
require_once __DIR__ . '/include/header.php';

$searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : '';
$products = [];

if ($searchValue) {
    $products = $product->search_products($searchValue);
}
?>

<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm</li>
            </ol>
        </nav>
        <h4 class="text-center text-danger mb-4">Kết quả tìm kiếm cho "<?php echo htmlspecialchars($searchValue); ?>"</h4>
        <hr>
        <div class="row">
            <?php if ($products): ?>
                <?php foreach ($products as $result): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 shadow-sm hover-effect">
                            <a href="product_detail.php?productId=<?php echo $result['productId']; ?>">
                                <img src="admin/uploads/<?php echo $result['productImage']; ?>" class="card-img-top p-3 hover-zoom" alt="<?php echo htmlspecialchars($result['productName']); ?>" style="object-fit: contain; height: 200px; border-radius: 10px;">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title text-center"><a class="text-decoration-none text-dark hover-link" href="product_detail.php?productId=<?php echo $result['productId']; ?>"><?php echo htmlspecialchars($result['productName']); ?></a></h6>
                                <div class="mt-auto">
                                    <p class="card-text text-center text-danger mb-1"><strong><?php echo $fm->format_currency($result['productPrice']); ?></strong></p>
                                    <p class="card-text text-center text-muted"><?php echo $fm->textShorten($result['productDesc'], 30); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Không tìm thấy sản phẩm nào cho tìm kiếm của bạn.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

<?php
require_once __DIR__ . '/include/footer.php';
?>