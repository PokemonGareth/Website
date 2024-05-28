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

    public function get_Review_by_Userid(int $Userid)
{
    $sql = "SELECT * FROM reviews WHERE Userid = :Userid";
    $args = ['Userid' => $Userid];
    return $this->db->runSQL($sql, $args)->fetchAll();
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

    public function update_Review($id, $Userid, $Content, $Stars) {
        $sql = 'UPDATE reviews SET Userid = :Userid, Content = :Content, Stars = :Stars WHERE Id = :Id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':Userid', $Userid);
        $stmt->bindValue(':Content', $Content);
        $stmt->bindValue(':Stars', $Stars);
        $stmt->bindValue(':Id', $id);
        $stmt->execute();
    }

    public function delete_Review(int $id)
    {
        $sql = "DELETE FROM reviews WHERE Id = :Id";
        $args = ['Id' => $id];
        return $this->db->runSQL($sql, $args)->execute();
    }

}

?>