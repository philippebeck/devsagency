<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class DevelopersController
 * @package App\Controller
 */
class DevelopersController extends MainController
{
    /**
     * @var array
     */
    private $developer = [];

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allDevelopers = ModelFactory::getModel("Developers")->listData();

        return $this->render("front/developers.twig", ["allDevelopers" => $allDevelopers]);
    }

    private function setDeveloperData()
    {
        $this->developer["name"]        = (string) trim($this->getPost("name"));
        $this->developer["email"]       = (string) trim($this->getPost("email"));
        $this->developer["linkedin"]    = (string) trim($this->getPost("linkedin"));
        $this->developer["github"]      = (string) trim($this->getPost("github"));

        $this->developer["website"] = (string) trim($this->getPost("website"));
        $this->developer["website"] = str_replace("https://", "", $this->developer["website"]);

        $this->developer["position"]        = (string) trim($this->getPost("position"));
        $this->developer["city"]            = (string) trim($this->getPost("city"));
        $this->developer["presentation"]    = (string) trim($this->getPost("presentation"));
    }

    private function setDeveloperImage()
    {
        $this->developer["image"] = $this->getString($this->developer["name"]) . $this->getExtension();

        $this->getUploadedFile("img/developers/", $this->getString($this->developer["name"]));
        $this->getThumbnail("img/developers/" . $this->developer["image"], 200);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        if ($this->checkArray($this->getPost())) {

            $this->setDeveloperData();
            $this->setDeveloperImage();

            ModelFactory::getModel("Developers")->createData($this->developer);

            $this->setSession([
                "message"   => "Nouveau Développeur créé avec succès !", 
                "type"      => "green"
            ]);

            $this->redirect("admin");
        }

        return $this->render("back/createDeveloper.twig");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updateMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        if ($this->checkArray($this->getPost())) {
            $this->setDeveloperData();

            if ($this->checkArray($this->getFiles("file"), "name")) {
                $this->setDeveloperImage();
            }

            ModelFactory::getModel("Developers")->updateData(
                $this->getGet("id"), 
                $this->developer
            );

            $this->setSession([
                "message"   => "Modification du Développeur sélectionné effectuée !", 
                "type"      => "blue"
            ]);

            $this->redirect("admin");
        }

        $developer = ModelFactory::getModel("Developers")->readData($this->getGet("id"));

        return $this->render("back/updateDeveloper.twig", ["developer" => $developer]);
    }

    public function deleteMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Developers")->deleteData($this->getGet("id"));

        $this->setSession([
            "message"   => "Développeur sélectionné supprimé !", 
            "type"      => "red"
        ]);

        $this->redirect("admin");
    }
}
