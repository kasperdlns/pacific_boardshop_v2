<?php
class AddToCart {
    private $conn;
    private $userId;  // Nieuwe eigenschap
    private $productId; // Nieuwe eigenschap

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($id) {
        $this->userId = $id;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($id) {
        $this->productId = $id;
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
        $conn = Db::getConnection();

        // Controleer of het product al in de winkelmand staat
        $sql = "SELECT * FROM cart WHERE users_id = :user_id AND products_id = :product_id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            // Product is al in de winkelmand
            throw new Exception("Dit product staat al in je winkelmand!");
        }

        // Voeg het product toe aan de winkelmand
        $sql = "INSERT INTO cart (users_id, products_id) VALUES (:user_id, :product_id)";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':product_id', $product_id);

        if ($statement->execute()) {
            return true; // Succes
        } else {
            throw new Exception("Er is iets misgegaan bij het toevoegen van het product aan je winkelmand.");
        }
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
