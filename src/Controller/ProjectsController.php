<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ProjectsController
 * @package App\Controller
 */
class ProjectsController extends MainController
{
    /**
     * @var array
     */
    private $project = [];

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allProjects = $this->getArrayElements(ModelFactory::getModel("Projects")->listData());

        return $this->render("front/projects.twig", [
            "tools"      => $allProjects["tool"],
            "websites"   => $allProjects["website"]
        ]);
    }

    private function setProjectData()
    {
        $this->project["name"]         = $this->getPost("name");
        $this->project["year"]         = $this->getPost("year");
        $this->project["category"]     = $this->getPost("category");
        $this->project["description"]  = trim($this->getPost("description"));

        $this->project["link"] = str_replace("https://", "", $this->getPost("link"));
    }

    private function setProjectPicture()
    {
        $this->project["image"] = $this->getString($this->project["name"]) . $this->getExtension();

        $this->getUploadedFile("img/projects/", $this->getString($this->project["name"]));
        $this->getThumbnail("img/projects/" . $this->project["image"], 300);
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

            $this->setProjectData();
            $this->setProjectPicture();

            ModelFactory::getModel("Projects")->createData($this->project);

            $this->setSession([
                "message"   => "Nouveau Projet Créé avec Succès !", 
                "type"      => "green"
            ]);

            $this->redirect("admin");
        }

        return $this->render("back/createProject.twig");
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
            $this->setProjectData();

            if ($this->checkArray($this->getFiles("file"), "name")) {
                $this->setProjectPicture();
            }

            ModelFactory::getModel("Projects")->updateData(
                $this->getGet("id"), 
                $this->project
            );
            
            $this->setSession([
                "message"   => "Modification du Projet Sélectionné Effectuée !", 
                "type"      => "blue"
            ]);

            $this->redirect("admin");
        }

        $project = ModelFactory::getModel("Projects")->readData($this->getGet("id"));

        return $this->render("back/updateProject.twig", ["project" => $project]);
    }

    public function deleteMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Projects")->deleteData($this->getGet("id"));

        $this->setSession([
            "message"   => "Projet Supprimé !", 
            "type"      => "red"
        ]);

        $this->redirect("admin");
    }
}
