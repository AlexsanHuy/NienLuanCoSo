<?php
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/../../classes/category.php";
require_once __DIR__ . "/../../classes/product.php";
?>
<?php
$product = new product();
if (isset($_GET['deleteproduct'])) {
    $productid = $_GET['deleteproduct'];
    $deleteproduct = $product->delete_product($productid);
}
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4">
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
            <div class="col-lg-9 col-md-9 col-sm-8">
                <div class="bg-secondary-subtle p-3 rounded h-100">
                    <h4 class="text-center">Danh sách sản phẩm</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Tên thương hiệu</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Loại</th>
                                <th>Sửa/Xóa</th>
                            </thead>
                            <?php
                            $product = new product();
                            $show_product = $product->show_product();
                            if ($show_product) {
                                $i = 1;
                                while ($result = $show_product->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $result['productName']; ?></td>
                                        <td><?php echo $result['catName']; ?></td>
                                        <td><img src="uploads/<?php echo $result['productImage']; ?>" alt="Hình ảnh sản phẩm" style="width: 100px; height: 100px;"></td>
                                        <td><?php echo $result['productPrice']; ?></td>
                                        <td><?php echo $result['productQuantity']; ?></td>
                                        <td><?php if ($result['productType'] == 1) {
                                                echo "Sản phẩm mới";
                                            } else {
                                                echo "Sản phẩm bán chạy";
                                            } ?></td>
                                        <td><a href="editproduct.php?editproduct=<?php echo $result['productId']; ?>"><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');" href="listproduct.php?deleteproduct=<?php echo $result['productId']; ?>"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once __DIR__ . "/include/footer.php";
?>

</html>