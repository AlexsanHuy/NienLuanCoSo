<?php
ob_start();
require_once __DIR__ . "/../../../config/session.php";
Session::checkSession();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bffd8e0555.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/images/logo.jpeg">
    <script src="/js/index.js"></script>
</head>

<header>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #1a2a3a;">
            <div class="container-fluid">
                <h2 class="text-white ms-5 logo-1"><a class="text-white logo-link text-decoration-none" href="index.php">Admin Panel</a></h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="nav d-flex align-items-center me-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-info" data-bs-toggle="dropdown" href="#">
                            <i class="fa fa-user-circle text-white me-2"></i>Xin chào: <?php echo Session::get("adminName"); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            }
                            ?>
                            <li><a class="dropdown-item text-danger" href="?action=logout"><i class="fa fa-sign-out me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
</header>