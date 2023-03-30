<?php

namespace Controller;

use stdClass;

class PostController extends Controller
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new \Model\Post();
    }

    function getAll()
    {
        $listpost = $this->postManager->getAll();
        $this->addViewParams("posts",$listpost);
        $this->View("listpost");
        //$this->JSON($this->postManager->getAll());
    }

    function getOne($id)
    {

        $this->JSON($this->postManager->getOne($id));
    }

    function create()
    {
        $auth = getAuth();
        if($auth){
            $post = new \stdClass();
            $post->name = $_POST["name"];
            $post->content = $_POST["content"];
            $post->creatorID = $auth->id;
            $post->date = $_POST["date"];
            // $post->login = $_POST["login"];
            // $post->password = $_POST["password"];
            $this->postManager->create($post);

            $this->JSONMessage("Post créé");
        }else{
            $this->JSONMessage("Vous n'êtes pas authentifié.");
        }
    }

    function update($id)
    {
        $auth = getAuth();
        if($auth){
            $creatorID = $this->postManager->getOne($id)->creatorID;
            if($auth->id == $creatorID){
                $post = new \stdClass();
                $post->id = $id;
                var_dump($_POST);
                $post->name = $_POST["name"];
                $post->content = $_POST["content"];
                $post->date = $_POST["date"];
                if ($this->postManager->update($post)) {
                    $this->JSONMessage("Post mis à jour");
                } else {
                    $this->JSONMessage("Post non trouvé");
                }
            }else{
                $this->JSONMessage("Vous n'avez pas les droits pour modifier ce post");
            }
        }else{
            $this->JSONMessage("Vous n'êtes pas authentifié.");
        }
    }

    function delete($id)
    {
        $auth = getAuth();
        if($auth){
            $creatorID = $this->postManager->getOne($id)->creatorID;
            if($auth->id == $creatorID){
                if ($this->postManager->delete($id)) {
                    $this->JSONMessage("Post supprimé");
                } else {
                    $this->JSONMessage("Post non trouvé");
                }
            }else{
                $this->JSONMessage("Vous n'avez pas les droits pour supprimer ce post");
            }
        }else{
            $this->JSONMessage("Vous n'êtes pas authentifié.");
        }
    }   
}
