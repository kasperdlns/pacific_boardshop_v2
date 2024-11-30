<?php
    class product {
        private $id;
        private $name;
        private $description;
        private $price;
        private $category;
        private $url;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
                $this->price = $price;

                return $this;
        }

        /**
         * Get the value of category
         */ 
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }

        /**
         * Get the value of url
         */ 
        public function getUrl()
        {
                return $this->url;
        }

        /**
         * Set the value of url
         *
         * @return  self
         */ 
        public function setUrl($url)
        {
                $this->url = $url;

                return $this;
        }

        public static function getAllProducts($db) {
            $query = "SELECT * FROM products";
            $statement = $db->prepare($query);
            $statement->execute();
            
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $products = [];
            
            foreach ($results as $result) {
                $product = new Product();
                $product->setId($result['id']);
                $product->setName($result['name']);
                $product->setDescription($result['description']);
                $product->setPrice($result['price']);
                $product->setCategory($result['category']);
                $product->setUrl($result['url']);
                
                $products[] = $product;
            }
            
            return $products;
        }

        public static function getProductsByCategory($conn, $category) {
                $statement = $conn->prepare("SELECT * FROM products WHERE category = :category");
                $statement->bindValue(':category', $category);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
                // Maak een array van Product-objecten
                $products = [];
                foreach ($result as $row) {
                    $product = new Product();
                    $product->setName($row['name']);
                    $product->setDescription($row['description']);
                    $product->setCategory($row['category']);
                    $product->setPrice($row['price']);
                    $product->setUrl($row['url']);
                    $products[] = $product;
                }
        
                return $products;
            }
    }
?>