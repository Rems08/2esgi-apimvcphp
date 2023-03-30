<?php
    namespace Model;

class Comment extends \Model\Model{
    public function __construct()
    {
        parent::__construct("comment");
    }

    public function getCommentById($id)
    {
        $req = $this->db->prepare("SELECT * FROM comment WHERE id=?");
        $req->execute(array($id));
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetch();
    }
}