<?php

namespace Controller;

use stdClass;

class CommentController extends Controller
{
    private $commentManager;

    public function __construct()
    {
        $this->commentManager = new \Model\Comment();
        $this->postManager = new \Model\Post();

    }

    function getAll()
    {
        $listcomment = $this->commentManager->getAll();
        //$this->addViewParams("comments",$listcomment);
        //$this->View("listcomment");
        $this->JSON($this->commentManager->getAll());
    }

    function getOne($id)
    {

        $this->JSON($this->commentManager->getOne($id));
    }

    function create()
    {
        $auth = getAuth();
        $post = $this->postManager->getPostById($_POST["postID"]);


        if($auth){
            if($post != false){
                $comment = new \stdClass();
                $comment->content = $_POST["content"];
                $comment->userID = $auth->id;
                $comment->postID = $_POST["postID"];
                // $comment->login = $_comment["login"];
                // $comment->password = $_comment["password"];
                $this->commentManager->create($comment);

                $this->JSONMessage("commentaire créé");
            }else {
                $this->JSONMessage("Ce post n'éxiste pas");
            }
        }else{
            $this->JSONMessage("Vous n'êtes pas authentifié.");
        }
    }

    function update($id)
    {
        $auth = getAuth();
        if($auth){
            if($auth->id == $comment->userID){
                $comment = new \stdClass();
                $comment->content = $_POST->content;
                $comment->userID = $auth->id;
                $comment->postID = $_POST->postID;
                var_dump($comment);
                if ($this->commentManager->update($comment)) {
                    $this->JSONMessage("comment mis à jour");
                } else {
                    $this->JSONMessage("comment non trouvé");
                }
            }else{
                $this->JSONMessage("Vous n'avez pas les droits pour modifier cet utilisateur");
            }
        }
    }

    function delete($id)
    {
        if ($this->commentManager->delete($id)) {
            $this->JSONMessage("comment supprimé");
        } else {
            $this->JSONMessage("comment non trouvé");
        }
    }   
}
