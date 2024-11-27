<?php
ob_start();
require_once __DIR__ . '/include/header.php';
?>

<body>
    <img src="/images/banner.png" width="100%" class="img-fluid bg-danger" alt="Banner">
    <div class="container mt-4">
        <div class="row bg-dark rounded shadow-lg p-3">
            <div class="col-md-6">
                <img class="img-fluid rounded hover-zoom mt-3" src="images/adver.png" width="100%" alt="Advertisement">
            </div>
            <div class="col-md-6">
                <div id="carouselExampleAutoplaying" class="carousel slide shadow" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="/images/slide.png" class="d-block w-100 hover-zoom" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/slide1.png" class="d-block w-100 hover-zoom" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/slide2.png" class="d-block w-100 hover-zoom" alt="Slide 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <hr class="my-4 gradient-hr">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
                    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary"><i class="fa fa-home"></i> Trang chủ</a></li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="bg-white rounded shadow-sm p-3 hover-effect">
                        <h5 class="text-center text-primary mb-3 fancy-title">Thương hiệu</h5>
                        <div class="list-group">
                            <?php
                            $category = $category->show_category();
                            if ($category) {
                                foreach ($category as $cat) {
                                    echo '<a class="list-group-item list-group-item-action hover-effect" href="productfilter.php?catName=' . $cat['catName'] . '">' . $cat['catName'] . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h4 class="text-center text-danger mb-4 fancy-title">Sản phẩm mới</h4>
                        <div class="row">
                            <?php
                            $product_seller = $product->get_product_new();
                            if ($product_seller) {
                                while ($result = $product_seller->fetch_assoc()) {
                            ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100 shadow-sm hover-effect">
                                            <a href="product_detail.php?productId=<?php echo $result['productId']; ?>">
                                                <img src="admin/uploads/<?php echo $result['productImage']; ?>" class="card-img-top p-3 hover-zoom" alt="<?php echo $result['productName']; ?>" style="object-fit: contain; height: 200px;">
                                            </a>
                                            <div class="card-body d-flex flex-column">
                                                <h6 class="card-title text-center"><a class="text-decoration-none text-dark hover-link" href="product_detail.php?productId=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a></h6>
                                                <div class="mt-auto">
                                                    <p class="card-text text-center text-danger mb-1"><strong><?php echo $fm->format_currency($result['productPrice']); ?></strong></p>
                                                    <p class="card-text text-center text-muted"><?php echo $fm->textShorten($result['productDesc'], 30); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <hr>
                        <h4 class="text-center text-danger mt-2 mb-4 fancy-title">Sản phẩm bán chạy</h4>
                        <div class="row">
                            <?php
                            $product_new = $product->seller();
                            if ($product_new) {
                                while ($result = $product_new->fetch_assoc()) {
                            ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100 shadow-sm hover-effect">
                                            <a href="product_detail.php?productId=<?php echo $result['productId']; ?>">
                                                <img src="admin/uploads/<?php echo $result['productImage']; ?>" class="card-img-top p-3 hover-zoom" alt="<?php echo $result['productName']; ?>" style="object-fit: contain; height: 200px;">
                                            </a>
                                            <div class="card-body d-flex flex-column">
                                                <h6 class="card-title text-center"><a class="text-decoration-none text-dark hover-link" href="product_detail.php?productId=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a></h6>
                                                <div class="mt-auto">
                                                    <p class="card-text text-center text-danger mb-1"><strong><?php echo $fm->format_currency($result['productPrice']); ?></strong></p>
                                                    <p class="card-text text-center text-muted"><?php echo $fm->textShorten($result['productDesc'], 30); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once __DIR__ . '/include/footer.php';
ob_end_flush();
?>