<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/format.php";
?>
<script src="/js/index.js"></script>
<?php
class customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data)
    {
        $customerName = mysqli_real_escape_string($this->db->link, $data['customerName']);
        $customerUsername = mysqli_real_escape_string($this->db->link, $data['customerUsername']);
        $customerEmail = mysqli_real_escape_string($this->db->link, $data['customerEmail']);
        $customerPassword = mysqli_real_escape_string($this->db->link, md5($data['customerPassword']));
        $customerConfirmPassword = mysqli_real_escape_string($this->db->link, md5($data['customerConfirmPassword']));
        if (empty($customerName) || empty($customerUsername) || empty($customerEmail) || empty($customerPassword)) {
            $customer_error = "<script>swal('Error!', 'Vui lòng điền đủ thông tin', 'error');</script>";
            return $customer_error;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$customerEmail' LIMIT 1";
            $result_check_email = mysqli_query($this->db->link, $check_email);
            $user_check = "SELECT * FROM tbl_customer WHERE userName = '$customerUsername' LIMIT 1";
            $result_user_check = mysqli_query($this->db->link, $user_check);
            if (mysqli_num_rows($result_check_email) > 0) {
                $customer_email_error = "<script>swal('Error!', 'Email đã tồn tại', 'error');</script>";
                return $customer_email_error;
            }
            if (mysqli_num_rows($result_user_check) > 0) {
                $customer_username_error = "<script>swal('Error!', 'Tên đăng nhập đã tồn tại', 'error');</script>";
                return $customer_username_error;
            } 
            if ($customerPassword != $customerConfirmPassword) {
                $customer_password_error = "<script>swal('Error!', 'Mật khẩu không khớp', 'error');</script>";
                return $customer_password_error;
            }
            else {
                $query = "INSERT INTO tbl_customer(name, userName, email, userPass) VALUES('$customerName', '$customerUsername', '$customerEmail', '$customerPassword')";
                $result = mysqli_query($this->db->link, $query);
                if ($result) {
                    $customer_success = "<script>swal('Success!', 'Đăng ký thành công', 'success');</script>";
                    return $customer_success;
                } else {
                    $customer_error = "<script>swal('Error!', 'Đăng ký thất bại', 'error');</script>";
                    return $customer_error;
                }
            }
        }
    }
    public function login_customer($data)
    {
        $customerUsername = mysqli_real_escape_string($this->db->link, $data['customerUsername']);
        $customerPassword = mysqli_real_escape_string($this->db->link, $data['customerPassword']);
        if (empty($customerUsername) || empty($customerPassword)) {
            return "<script>swal('Error!', 'Tên đăng nhập hoặc mật khẩu không được để trống', 'error');</script>";
        }
        $query = "SELECT * FROM tbl_customer WHERE userName = '$customerUsername' LIMIT 1";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (md5($customerPassword) == $user['userPass']) {
                Session::set("login", true);
                Session::set("customerName", $user['name']);
                Session::set("customerId", $user['customer_id']);
                Session::set("customerUsername", $user['userName']);
                Session::set("customerEmail", $user['email']);
                header("Location: index.php");
                exit();
            }
        }
        return "<script>swal('Error!', 'Tên đăng nhập hoặc mật khẩu không đúng', 'error');</script>";
    }

}
