<?php
require_once __DIR__ . "/../../classes/category.php";
require_once __DIR__ . "/../../classes/product.php";
require_once __DIR__ . "/include/header.php";
$product = new product();
if (isset($_GET['editproduct']) && $_GET['editproduct'] == null) {
    echo  "<script>window.location.href='listproduct.php'</script>";
} else {
    $id = $_GET['editproduct'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $product->update_product($_POST, $_FILES, $id);
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
                    <h4 class="text-center">Sửa sản phẩm</h4>
                    <hr>
                    <?php
                    if (isset($updateProduct)) {
                        echo $updateProduct;
                    }
                    ?>
                    <?php
                    $product_by_id = $product->get_product_by_id($id);
                    if ($product_by_id) {
                        while ($result = $product_by_id->fetch_assoc()) {
                    ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control w-100" type="text" name="productName" value="<?php echo $result['productName']; ?>">
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
                                        <textarea class="form-control w-100 mt-3" name="productDesc"><?php echo $result['productDesc']; ?></textarea>
                                        <input class="form-control w-100 mt-3" type="number" name="productPrice" value="<?php echo $result['productPrice']; ?>">
                                        <td><img class="mt-3" src="uploads/<?php echo $result['productImage']; ?>" style="width: 100px; height: 100px;"></td>
                                        <input class="form-control w-100 mt-3" type="file" name="productImage">
                                        <input class="form-control w-100 mt-3" type="number" name="productQuantity" value="<?php echo $result['productQuantity']; ?>">
                                        <select class="form-select w-100 mt-3" name="productType">
                                            <?php
                                            if ($result['productType'] == 1) {
                                                echo '<option selected value="1">Sản phẩm mới</option>';
                                                echo '<option value="2">Sản phẩm bán chạy</option>';
                                            } else {
                                                echo '<option value="1">Sản phẩm mới</option>';
                                                echo '<option selected value="2">Sản phẩm bán chạy</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <input class="form-control w-100" type="text" name="productScreen" value="<?php echo $result['productScreen']; ?>">
                                                <input class="form-control w-100 mt-3" type="text" name="productCamera" value="<?php echo $result['productCamera']; ?>">
                                                <input class="form-control w-100 mt-3" type="text" name="productFrontcamera" value="<?php echo $result['productFrontcamera']; ?>">
                                                <input class="form-control w-100 mt-3" type="text" name="productChip" value="<?php echo $result['productChip']; ?>">
                                                <input class="form-control w-100 mt-3" type="text" name="productPin" value="<?php echo $result['productPin']; ?>">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <input class="form-control w-100" type="text" name="productRam" value="<?php echo $result['productRam']; ?>">
                                                <input class="form-control w-100 mt-3" type="text" name="productRom" value="<?php echo $result['productRom']; ?>">
                                                <input class="form-control w-100 mt-3" type="text" name="productOs" value="<?php echo $result['productOs']; ?>">
                                                <input class="form-control w-100 mt-3" type="text" name="productResolution" value="<?php echo $result['productResolution']; ?>">
                                                <select class="form-select w-100 mt-3" name="productNfc">
                                                    <?php
                                                    if ($result['productNfc'] == 1) {
                                                        echo '<option selected value="1">Có</option>';
                                                        echo '<option value="0">Không</option>';
                                                    } else {
                                                        echo '<option value="1">Có</option>';
                                                        echo '<option selected value="0">Không</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success mt-3" type="submit" name="submit">Hoàn tất</button>
                                    <a href="listproduct.php" class="btn btn-danger mt-3">Hủy</a>
                                </div>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once __DIR__ . "/include/footer.php";
?>

</html>