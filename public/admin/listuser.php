<?php
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/../../classes/user.php";
$user = new user();
if (isset($_GET['deleteuser'])) {
    $delete_id = $_GET['deleteuser'];
    $delete_user = $user->delete_user($delete_id);
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
            <div class="col-md-9 col-sm-12">
                <div class="bg-secondary-subtle p-3 rounded h-100">
                    <h4 class="text-center">Quản lý tài khoản người dùng</h4>
                    <hr>
                    <?php
                    if (isset($delete_user)) {
                        echo $delete_user;
                    }
                    ?>
                    <?php
                    $show_user = $user->show_user();
                    ?>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <th>STT</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Tên đăng nhập</th>
                                <th>Mật khẩu</th>
                                <th>Xóa</th>
                            </thead>
                            <?php
                            $i = 1;
                            while ($result = $show_user->fetch_assoc()) {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $result['name']; ?></td>
                                    <td><?php echo $result['email']; ?></td>
                                    <td><?php echo $result['userName']; ?></td>
                                    <td><?php echo $result['userPass']; ?></td>
                                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');" href="listuser.php?deleteuser=<?php echo $result['customer_id']; ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            </tbody>
                            <?php
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