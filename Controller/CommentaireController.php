<?php

namespace Controller;

use stdClass;

class CommentaireController extends Controller
{
    private $commentaireManager;

    public function __construct()
    {
        $this->commentaireManager = new \Model\Commentaire();
    }

    function getAll()
    {
        $listcommentaire = $this->commentaireManager->getAll();
        $this->addViewParams("commentaires",$listcommentaire);
        $this->View("listcommentaire");
        //$this->JSON($this->commentairecommentaire->getAll());
    }

    function getOne($id)
    {

        $this->JSON($this->commentaireManager->getOne($id));
    }

    function create()
    {
        $auth = getAuth();
        if($auth){
            $commentaire = new \stdClass();
            $commentaire->name = $_commentaire["name"];
            $commentaire->content = $_commentaire["content"];
            $commentaire->creatorID = $auth->id;
            $commentaire->date = $_commentaire["date"];
            // $commentaire->login = $_commentaire["login"];
            // $commentaire->password = $_commentaire["password"];
            $this->commentaireManager->create($commentaire);

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
                $commentaire = new \stdClass();
                $commentaire->id = $id;
                $commentaire->name = $data->name;
                $commentaire->content = $data->content;
                $commentaire->date = $data->date;
                var_dump($commentaire);
                if ($this->commentaireManager->update($commentaire)) {
                    $this->JSONMessage("commentaire mis à jour");
                } else {
                    $this->JSONMessage("commentaire non trouvé");
                }
            }else{
                $this->JSONMessage("Vous n'avez pas les droits pour modifier cet utilisateur");
            }
        }
    }

    function delete($id)
    {
        if ($this->commentaireManager->delete($id)) {
            $this->JSONMessage("commentaire supprimé");
        } else {
            $this->JSONMessage("commentaire non trouvé");
        }
    }   
}
