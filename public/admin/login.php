<?php
require_once __DIR__ . "/../../classes/adminlogin.php";
?>
<?php
$adminlogin = new adminlogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminUser = $_POST['adminUser'];
    $adminPass = md5($_POST['adminPass']);
    $login_check = $adminlogin->login_admin($adminUser, $adminPass);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/index.js"></script>
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        body {
            background-image: url(../images/adminback.jpg);
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: transparent;
            border-bottom: none;
            padding-top: 30px;
        }

        .card-header h3 {
            color: #333;
            font-weight: 700;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            padding: 10px 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Đăng nhập</h3>
                    </div>
                    <?php
                    if (isset($login_check)) {
                        if ($login_check == "Empty") {
                            echo "<script>swal('Warning!', 'Tên đăng nhập hoặc mật khẩu không được để trống!', 'warning');</script>";
                        } else if ($login_check == "Wrong") {
                            echo "<script>swal('Warning!', 'Tên đăng nhập hoặc mật khẩu không đúng!', 'warning');</script>";
                        }
                    }
                    ?>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <div class="mb-4">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" placeholder="Nhập tên đăng nhập" name="adminUser">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="adminPass">
                            </div>
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>