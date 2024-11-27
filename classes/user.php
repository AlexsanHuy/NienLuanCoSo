<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/format.php";
?>
<script src="/js/index.js"></script>
<?php
class user
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function show_user()
    {
        $query = "SELECT * FROM tbl_customer";
        $result = mysqli_query($this->db->link, $query);
        return $result;
    }

    public function delete_user($id)
    {
        $query = "DELETE FROM tbl_customer WHERE customer_id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<script>swal('Success!', 'Xóa tài khoản người dùng thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Xóa tài khoản người dùng thất bại!', 'error');</script>";
        }
    }
}
?>