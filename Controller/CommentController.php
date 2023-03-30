<?php

namespace Controller;

use stdClass;

class CommentController extends Controller
{
    private $commentManager;

    public function __construct()
    {
        $this->commentManager = new \Model\Comment();
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
        if($auth){
            $comment = new \stdClass();
            $comment->id = $_comment["id"];
            $comment->content = $_comment["content"];
            $comment->userID = $auth->id;
            $comment->postID = $_comment["postID"];
            // $comment->login = $_comment["login"];
            // $comment->password = $_comment["password"];
            $this->commentManager->create($comment);

            $this->JSONMessage("commentaire créé");
        }else{
            $this->JSONMessage("Vous n'êtes pas authentifié.");
        }
    }

    function update($id)
    {
        $auth = getAuth();
        if($auth){
            if($auth->id == $creatorID){
                $data = json_decode(file_get_contents("php://input"));
                $comment = new \stdClass();
                $comment->id = $id;
                $comment->name = $data->name;
                $comment->content = $data->content;
                $comment->date = $data->date;
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
