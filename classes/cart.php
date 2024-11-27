<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../config/format.php";
?>
<script src="/js/index.js"></script>
<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_cart($quantity, $productId)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $sessionId = session_id();
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        $productName = $result['productName'];
        $productPrice = $result['productPrice'];
        $productImage = $result['productImage'];
        $query_insert = "INSERT INTO tbl_cart(productId,sessionId,productName, productPrice, quantity,image ) VALUES('$productId', '$sessionId', '$productName', '$productPrice', '$quantity', '$productImage')";
        $insert_cart = $this->db->insert($query_insert);
        if ($insert_cart) {
            return "<script>swal('Success!', 'Thêm vào giỏ hàng thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Thêm vào giỏ hàng thất bại. Vui lòng thử lại!', 'error');</script>";
        }
    }

    public function get_cart()
    {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            return "<script>swal('Success!', 'Cập nhật giỏ hàng thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Cập nhật giỏ hàng thất bại. Vui lòng thử lại!', 'error');</script>";
        }
    }

    public function delete_cart($cartId)
    {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<script>swal('Success!', 'Xóa sản phẩm thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Xóa sản phẩm thất bại. Vui lòng thử lại!', 'error');</script>";
        }
    }

    public function check_cart()
    {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_cart_logout()
    {
        $sessionId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function insertOrder($data)
    {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result_get = $this->db->select($query);
        if ($result_get) {
            $customerId = Session::get("customerId");
            $customerPhone = isset($data['phone']) ? $data['phone'] : '';
            $customerName = isset($data['fullName']) ? $data['fullName'] : '';
            $shippingAddress = isset($data['address']) ? $data['address'] : '';
            $paymentMethod = isset($data['paymentMethod']) ? $data['paymentMethod'] : '';
            $query_order = "INSERT INTO tbl_order_list (customerName, customerPhone, customerAdd, paymentMethod, customer_id) VALUES ('$customerName', '$customerPhone', '$shippingAddress', '$paymentMethod', '$customerId')";
            $insert_order = $this->db->insert($query_order);
            if (!$insert_order) {
                return "<script>swal('Error!', 'Thêm đơn hàng thất bại. Vui lòng thử lại!', 'error');</script>";
            }
            $orderId = mysqli_insert_id($this->db->link);
            while ($result = $result_get->fetch_assoc()) {
                $productId = $result['productId'];
                $quantity = $result['quantity'];
                $productName = $result['productName'];
                $productImage = $result['image'];
                $price = $result['productPrice'] * $quantity;

                $query_order_list = "INSERT INTO tbl_order(productId, productName, quantity, price, image, order_id) VALUES ('$productId', '$productName', '$quantity', '$price', '$productImage', '$orderId')";
                $insert_order_list = $this->db->insert($query_order_list);
            }
        }
    }

    public function get_cart_ordered()
    {
        $query = "SELECT * FROM tbl_order_list ORDER BY order_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_cart_ordered_by_customerId($customerId)
    {
        $query = "SELECT * FROM tbl_order_list WHERE customer_id = '$customerId' ORDER BY order_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_order_details($orderId)
    {
        $query = "SELECT * FROM tbl_order WHERE order_id = '$orderId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_order($orderId)
    {
        $query = "DELETE FROM tbl_order_list WHERE order_id = '$orderId'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<script>swal('Success!', 'Xóa đơn hàng thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Xóa đơn hàng thất bại. Vui lòng thử lại!', 'error');</script>";
        }
    }

    public function get_info_order($orderId)
    {
        $query = "SELECT * FROM tbl_order_list WHERE order_id = '$orderId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_status($orderId, $status)
    {
        $query = "UPDATE tbl_order_list SET status = '$status' WHERE order_id = '$orderId'";
        $result = $this->db->update($query);
        if ($result) {
            return "<script>swal('Success!', 'Cập nhật trạng thái đơn hàng thành công!', 'success');</script>";
        } else {
            return "<script>swal('Error!', 'Cập nhật trạng thái đơn hàng thất bại. Vui lòng thử lại!', 'error');</script>";
        }
    }
}
