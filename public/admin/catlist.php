<?php
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/../../classes/category.php";
$cat = new category();
if (isset($_GET['deletecat'])) {
    $catid = $_GET['deletecat'];
    $deletecat = $cat->delete_category($catid);
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
                    <h4 class="text-center">Danh sách thương hiệu</h4>
                    <hr>
                    <?php
                    if (isset($deletecat)) {
                        echo $deletecat;
                    }
                    ?>
                    <table class="table text-center">
                        <thead>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Xóa</th>
                        </thead>
                        <?php
                        $cat = new category();
                        $show_category = $cat->show_category();
                        if ($show_category) {
                            $i = 1;
                            while ($result = $show_category->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $result['catName']; ?></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?');" href="catlist.php?deletecat=<?php echo $result['catId']; ?>"><i class="fa fa-trash"></i></a></td>
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
</body>

<?php
require_once __DIR__ . "/include/footer.php";
?>

</html>