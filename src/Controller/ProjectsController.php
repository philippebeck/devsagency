<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
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
        $allProjects = $this->getArray()->getArrayElements(ModelFactory::getModel("Projects")->listData());

        return $this->render("front/projects.twig", [
            "tools"      => $allProjects["tool"],
            "websites"   => $allProjects["website"]
        ]);
    }

    private function setProjectData()
    {
        $this->project["name"]         = $this->getPost()->getPostVar("name");
        $this->project["year"]         = $this->getPost()->getPostVar("year");
        $this->project["category"]     = $this->getPost()->getPostVar("category");
        $this->project["description"]  = $this->getPost()->getPostVar("description");

        $this->project["link"] = str_replace("https://", "", $this->getPost()->getPostVar("link"));
    }

    private function setProjectPicture()
    {
        $this->project["image"] = $this->getString()->cleanString($this->project["name"]) . $this->getFiles()->setFileExtension();

        $this->getFiles()->uploadFile("img/projects/", $this->getString()->cleanString($this->project["name"]));
        $this->getImage()->makeThumbnail("img/projects/" . $this->project["image"], 300);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        if (!empty($this->getPost()->getPostArray())) {
            $this->setProjectData();
            $this->setProjectPicture();

            ModelFactory::getModel("Projects")->createData($this->project);
            $this->getSession()->createAlert("New project created successfully !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/projects/createProject.twig");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updateMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        if (!empty($this->getPost()->getPostArray())) {
            $this->setProjectData();

            if (!empty($this->getFiles()->getFileVar("name"))) {
                $this->setProjectPicture();
            }

            ModelFactory::getModel("Projects")->updateData($this->getGet()->getGetVar("id"), $this->project);
            $this->getSession()->createAlert("Successful modification of the selected project !", "blue");

            $this->redirect("admin");
        }

        $project = ModelFactory::getModel("Projects")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/projects/updateProject.twig", ["project" => $project]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Projects")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Project actually deleted !", "red");

        $this->redirect("admin");
    }
}
