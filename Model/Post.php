<?php
    namespace Model;

class Post extends \Model\Model{
    public function __construct()
    {
        parent::__construct("post");
    }

    public function getPostById($id)
    {
        $req = $this->db->prepare("SELECT * FROM post WHERE id=?");
        $req->execute(array($id));
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetch();
    }

    public function getCommentByPost($id)
    {
        $req = $this->db->prepare("SELECT * FROM comment WHERE postID = ?");
        $req->execute(array($id));
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    public function getCreatorOfPost($id)
    {
        $req = $this->db->prepare("SELECT * FROM user WHERE id=?");
        $req->execute(array($id));
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetch();
    }

    public function getCreatorOfComment($listCommentaires)
    {
        foreach($listCommentaires as $commentaires) {
            $req = $this->db->prepare("SELECT * FROM user WHERE id=?");
            $req->execute(array($commentaires->userID));
            $req->setFetchMode(\PDO::FETCH_OBJ);
            return $req->fetch();
        }
    }
}