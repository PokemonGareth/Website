<?php

class ProductController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    
    public function create_product(array $product) 
    {
        
        $sql = "INSERT INTO products(name, description, price, image)
        VALUES (:name, :description, :price, :image);";
        $this->db->runSQL($sql, $product);
        return $this->db->lastInsertId();
    }

    public function get_product_by_id(int $id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_products()
    {
        $sql = "SELECT * FROM products";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function update_product($id, $name, $description, $price, $image) {
        $sql = 'UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function delete_product(int $id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>