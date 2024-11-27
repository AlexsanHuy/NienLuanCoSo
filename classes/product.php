<?php
require_once __DIR__ . "/../config/format.php";
require_once __DIR__ . "/../config/database.php";
?>
<script src="/js/index.js"></script>
<?php
class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
        $productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
        $productType = mysqli_real_escape_string($this->db->link, $data['productType']);
        $file_name = $files['productImage']['name'];
        $file_size = $files['productImage']['size'];
        $file_tmp = $files['productImage']['tmp_name'];
        $file_permit = array('jpg', 'jpeg', 'png');
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;
        $productScreen = mysqli_real_escape_string($this->db->link, $data['productScreen']);
        $productCamera = mysqli_real_escape_string($this->db->link, $data['productCamera']);
        $productFrontcamera = mysqli_real_escape_string($this->db->link, $data['productFrontcamera']);
        $productChip = mysqli_real_escape_string($this->db->link, $data['productChip']);
        $productPin = mysqli_real_escape_string($this->db->link, $data['productPin']);
        $productRam = mysqli_real_escape_string($this->db->link, $data['productRam']);
        $productRom = mysqli_real_escape_string($this->db->link, $data['productRom']);
        $productOs = mysqli_real_escape_string($this->db->link, $data['productOs']);
        $productResolution = mysqli_real_escape_string($this->db->link, $data['productResolution']);
        $productNfc = mysqli_real_escape_string($this->db->link, $data['productNfc']);
        if (empty($productName) || empty($productDesc) || empty($productPrice) || empty($productQuantity) || empty($productType) || empty($file_name)) {
            $result = "<span style='color: red; text-align: center;'>Fill all field!</span>";
            return $result;
        } else {
            move_uploaded_file($file_tmp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, productDesc, productPrice, productImage, productQuantity, productType, productScreen, productCamera, productFrontcamera, productChip, productPin, productRam, productRom, productOs, productResolution, productNfc) VALUES('$productName', '$catId', '$productDesc', '$productPrice', '$unique_image', '$productQuantity', '$productType', '$productScreen', '$productCamera', '$productFrontcamera', '$productChip', '$productPin', '$productRam', '$productRom', '$productOs', '$productResolution', '$productNfc')";
            $result = $this->db->insert($query);
            if ($result) {
                return "<script>swal('Success!', 'Thêm sản phẩm thành công!', 'success');</script>";
            } else {
                return "<script>swal('Error!', 'Thêm sản phẩm thất bại!', 'error');</script>";
            }
        }
    }
    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_category.catName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId ORDER BY tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_by_id($productId)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $productId)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
        $productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
        $productType = mysqli_real_escape_string($this->db->link, $data['productType']);
        $file_name = $files['productImage']['name'];
        $file_size = $files['productImage']['size'];
        $file_tmp = $files['productImage']['tmp_name'];
        $file_permit = array('jpg', 'jpeg', 'png');
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;
        $productScreen = mysqli_real_escape_string($this->db->link, $data['productScreen']);
        $productCamera = mysqli_real_escape_string($this->db->link, $data['productCamera']);
        $productFrontcamera = mysqli_real_escape_string($this->db->link, $data['productFrontcamera']);
        $productChip = mysqli_real_escape_string($this->db->link, $data['productChip']);
        $productPin = mysqli_real_escape_string($this->db->link, $data['productPin']);
        $productRam = mysqli_real_escape_string($this->db->link, $data['productRam']);
        $productRom = mysqli_real_escape_string($this->db->link, $data['productRom']);
        $productOs = mysqli_real_escape_string($this->db->link, $data['productOs']);
        $productResolution = mysqli_real_escape_string($this->db->link, $data['productResolution']);
        $productNfc = mysqli_real_escape_string($this->db->link, $data['productNfc']);
        if (empty($productName) || empty($productDesc) || empty($productPrice) || empty($productQuantity) || empty($productType)) {
            $result = "<script>swal('Error!', 'Vui lòng điền đủ thông tin', 'error');</script>";
            return $result;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 5000000) {
                    $result = "<script>swal('Error!', 'Kích thước ảnh phải nhỏ hơn 5MB!', 'error');</script>";
                    return $result;
                } elseif (in_array($file_ext, $file_permit) == false) {
                    $result = "<script>swal('Error!', 'Ảnh phải là định dạng: " . implode(',', $file_permit) . "!', 'error');</script>";
                    return $result;
                }
                $query = "UPDATE tbl_product SET productName = '$productName', catId = '$catId', productDesc = '$productDesc', productPrice = '$productPrice', productImage = '$unique_image', productQuantity = '$productQuantity', productType = '$productType', productScreen = '$productScreen', productcamera = '$productCamera', productFrontcamera = '$productFrontcamera', productChip = '$productChip', productPin = '$productPin', productRam = '$productRam', productRom = '$productRom', productOs = '$productOs', productResolution = '$productResolution', productNfc = '$productNfc' WHERE productId = '$productId'";
            } else {
                $query = "UPDATE tbl_product SET productName = '$productName', catId = '$catId', productDesc = '$productDesc', productPrice = '$productPrice', productQuantity = '$productQuantity', productType = '$productType', productScreen = '$productScreen', productcamera = '$productCamera', productFrontcamera = '$productFrontcamera', productChip = '$productChip', productPin = '$productPin', productRam = '$productRam', productRom = '$productRom', productOs = '$productOs', productResolution = '$productResolution', productNfc = '$productNfc' WHERE productId = '$productId'";
            }
            move_uploaded_file($file_tmp, $uploaded_image);
            $result = $this->db->update($query);
            if ($result) {
                return "<script>swal('Success!', 'Cập nhật sản phẩm thành công!', 'success');</script>";
            } else {
                return "<script>swal('Error!', 'Cập nhật sản phẩm thất bại!', 'error');</script>";
            }
        }
    }
    public function delete_product($productId)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<script>swal('Success!', 'Xóa sản phẩm thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Xóa sản phẩm thất bại!', 'error');</script>";
        }
    }

  
    public function get_product_new()
    {
        $query = "SELECT * FROM tbl_product WHERE productType = '1' ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function seller()
    {
        $query = "SELECT * FROM tbl_product WHERE productType = '2' ORDER BY productId ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_detail_product($productId)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function product_filter($catName)
    {
        $query = "SELECT * FROM tbl_product WHERE catId = (SELECT catId FROM tbl_category WHERE catName = '$catName')";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_products($searchValue)
    {
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$searchValue%'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>