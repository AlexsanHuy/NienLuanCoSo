<?php
require_once __DIR__ . "/../../classes/category.php";
require_once __DIR__ . "/../../classes/product.php";
require_once __DIR__ . "/include/header.php";
$product = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertProduct = $product->insert_product($_POST, $_FILES);
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
                    <h4 class="text-center">Thêm sản phẩm</h4>
                    <hr>
                    <?php
                    if (isset($insertProduct)) {
                        echo $insertProduct;
                    }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <input class="form-control w-100" type="text" name="productName" placeholder="Nhập tên sản phẩm">
                                <select class="form-select w-100 mt-3" name="catId">
                                    <option value="">Chọn thương hiệu</option>
                                    <?php
                                    $category = new Category();
                                    $categories = $category->show_category();
                                    foreach ($categories as $category) {
                                        echo '<option value="' . $category['catId'] . '">' . $category['catName'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <textarea class="form-control w-100 mt-3" name="productDesc" placeholder="Nhập mô tả sản phẩm"></textarea>
                                <input class="form-control w-100 mt-3" type="number" name="productPrice" placeholder="Nhập giá sản phẩm">
                                <input class="form-control w-100 mt-3" type="file" name="productImage" placeholder="Nhập hình ảnh sản phẩm">
                                <input class="form-control w-100 mt-3" type="number" name="productQuantity" placeholder="Nhập số lượng sản phẩm">
                                <select class="form-select w-100 mt-3" name="productType">
                                    <option value="">Chọn loại sản phẩm</option>
                                    <option value="1">Sản phẩm mới</option>
                                    <option value="2">Sản phẩm bán chạy</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control w-100" type="text" name="productScreen" placeholder="Kích thước màn hình">
                                        <input class="form-control w-100 mt-3" type="text" name="productCamera" placeholder="Camera sau">
                                        <input class="form-control w-100 mt-3" type="text" name="productFrontcamera" placeholder="Camera trước">
                                        <input class="form-control w-100 mt-3" type="text" name="productChip" placeholder="Chip">
                                        <input class="form-control w-100 mt-3" type="text" name="productPin" placeholder="Pin">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control w-100" type="text" name="productRam" placeholder="RAM">
                                        <input class="form-control w-100 mt-3" type="text" name="productRom" placeholder="Bộ nhớ trong">
                                        <input class="form-control w-100 mt-3" type="text" name="productOs" placeholder="Hệ điều hành">
                                        <input class="form-control w-100 mt-3" type="text" name="productResolution" placeholder="Độ phân giải">
                                        <select class="form-select w-100 mt-3" name="productNfc">
                                            <option value="">NFC</option>
                                            <option value="1">Có</option>
                                            <option value="0">Không</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success mt-3" type="submit" name="submit">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once __DIR__ . "/include/footer.php";
?>

</html>