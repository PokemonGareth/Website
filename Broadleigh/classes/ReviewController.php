<?php

class ReviewController {

    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function create_Review(array $Review) 
    {
        
        $sql = "INSERT INTO reviews(Userid, Content, Stars)
        VALUES (:Userid, :Content, :Stars);";
        $this->db->runSQL($sql, $Review);
        return $this->db->lastInsertId();
    }

    public function get_Review_by_id(int $id)
    {
        $sql = "SELECT * FROM reviews WHERE Id = :Id";
        $args = ['Id' => $id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_Reviews()
    {
        $sql = "SELECT * FROM reviews";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function update_Review(array $Review)
    {
        $sql = "UPDATE reviews SET Userid = :Userid, Content = :Content, Stars = :Stars WHERE Id = :Id";
        return $this->db->runSQL($sql, $Review)->execute();
    }

    public function delete_Review(int $id)
    {
        $sql = "DELETE FROM reviews WHERE Id = :Id";
        $args = ['Id' => $id];
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>