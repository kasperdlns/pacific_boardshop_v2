<?php

class Cart {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addToCart($users_id, $products_id) {
        // Controleer of het product al in de winkelmand zit
        $sql = "SELECT * FROM cart WHERE users_id = :users_id AND products_id = :products_id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':users_id', $users_id);
        $statement->bindParam(':products_id', $products_id);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            // Het product zit al in de winkelmand
            echo "<p>Product zit al in de winkelmand.</p>";
        } else {
            // Voeg het product toe aan de winkelmand
            $sql = "INSERT INTO cart (users_id, products_id) VALUES (:users_id, :products_id)";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(':users_id', $users_id);
            $statement->bindParam(':products_id', $products_id);
            $statement->execute();

            echo "<p>Product toegevoegd aan de winkelmand.</p>";
        }
    }
}
