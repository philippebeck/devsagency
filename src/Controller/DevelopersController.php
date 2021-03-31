<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
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
        $this->developer["name"]         = (string) trim($this->getPost()->getPostVar("name"));
        $this->developer["email"]        = (string) trim($this->getPost()->getPostVar("email"));
        $this->developer["linkedin"]     = (string) trim($this->getPost()->getPostVar("linkedin"));
        $this->developer["github"]       = (string) trim($this->getPost()->getPostVar("github"));
        $this->developer["website"]      = (string) trim($this->getPost()->getPostVar("website"));
        $this->developer["position"]     = (string) trim($this->getPost()->getPostVar("position"));
        $this->developer["city"]         = (string) trim($this->getPost()->getPostVar("city"));
        $this->developer["presentation"] = (string) trim($this->getPost()->getPostVar("presentation"));
    }

    private function setDeveloperImage()
    {
        $this->developer["image"] = $this->getString()->cleanString($this->developer["name"]) . $this->getFiles()->setFileExtension();

        $this->getFiles()->uploadFile("img/developers/", $this->getString()->cleanString($this->developer["name"]));
        $this->getImage()->makeThumbnail("img/developers/" . $this->developer["image"], 150);
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
            $this->setDeveloperData();
            $this->setDeveloperImage();

            ModelFactory::getModel("Developers")->createData($this->developer);
            $this->getSession()->createAlert("Nouveau Développeur créé avec succès !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/developers/createDeveloper.twig");
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
            $this->setDeveloperData();

            if (!empty($this->getFiles()->getFileVar("name"))) {
                $this->setDeveloperImage();
            }

            ModelFactory::getModel("Developers")->updateData($this->getGet()->getGetVar("id"), $this->developer);
            $this->getSession()->createAlert("Modification du Développeur sélectionné effectuée !", "blue");

            $this->redirect("admin");
        }

        $developer = ModelFactory::getModel("Developers")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/developers/updateDeveloper.twig", ["developer" => $developer]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Developers")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Développeur sélectionné supprimé !", "red");

        $this->redirect("admin");
    }
}
