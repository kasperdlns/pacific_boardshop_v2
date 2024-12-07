<?php
class AddToCart {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function productExistsInCart($user_id, $product_id) {
        $sql = "SELECT * FROM cart WHERE users_id = :user_id AND products_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function addProductToCart($user_id, $product_id) {
        if ($this->productExistsInCart($user_id, $product_id)) {
            return false;  // Product staat al in de winkelmand
        }

        $sqlInsert = "INSERT INTO cart (users_id, products_id) VALUES (:user_id, :product_id)";
        $stmtInsert = $this->conn->prepare($sqlInsert);
        $stmtInsert->bindValue(':user_id', $user_id);
        $stmtInsert->bindValue(':product_id', $product_id);

        return $stmtInsert->execute();
    }

    public function removeProductFromCart($user_id, $product_id) {
        $sqlDelete = "DELETE FROM cart WHERE users_id = :user_id AND products_id = :product_id";
        $stmtDelete = $this->conn->prepare($sqlDelete);
        $stmtDelete->bindValue(':user_id', $user_id);
        $stmtDelete->bindValue(':product_id', $product_id);
    
        return $stmtDelete->execute();
    }
    
}
?>
