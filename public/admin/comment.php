<?php
require_once __DIR__ . "/include/header.php";
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
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
            <div class="col-9">
                <div class="bg-secondary-subtle p-3 rounded h-100">
                    <h4 class="text-center">Quản lý bình luận</h4>
                    <hr>
                    <h5>Các chức năng được hiển thị ở bên trái</h5>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once __DIR__ . "/include/footer.php";
?>

</html>