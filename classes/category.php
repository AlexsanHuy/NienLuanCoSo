<?php
require_once __DIR__ . "/../config/format.php";
require_once __DIR__ . "/../config/database.php";
?>
<script src="/js/index.js"></script>
<?php 
class category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $result = "<script>swal('Warning!', 'Tên danh mục không được để trống!', 'warning');</script>";
            return $result;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $result = $this->db->insert($query);
            if ($result) {
                return "<script>swal('Success!', 'Thêm danh mục thành công!', 'success');</script>";
            } else {
                return "<script>swal('Error!', 'Thêm danh mục thất bại!', 'error');</script>";
            }
        }
    }
    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_category($catid)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$catid'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<script>swal('Success!', 'Xóa danh mục thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Xóa danh mục thất bại!', 'error');</script>";
        }
    }
}
?>