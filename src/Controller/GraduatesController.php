<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class GraduatesController
 * @package App\Controller
 */
class GraduatesController extends MainController
{
    /**
     * @var array
     */
    private $graduate = [];

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allGraduates = ModelFactory::getModel("Graduates")->listData();

        return $this->render("front/graduates.twig", ["allGraduates" => $allGraduates]);
    }

    private function setGraduateData()
    {
        $this->graduate["name"]           = $this->getPost()->getPostVar("name");
        $this->graduate["email"]          = $this->getPost()->getPostVar("email");
        $this->graduate["linkedin"]       = $this->getPost()->getPostVar("linkedin");
        $this->graduate["website"]        = $this->getPost()->getPostVar("website");
        $this->graduate["position"]       = $this->getPost()->getPostVar("position");
        $this->graduate["city"]           = $this->getPost()->getPostVar("city");
        $this->graduate["presentation"]   = $this->getPost()->getPostVar("presentation");
    }

    private function setGraduateImage()
    {
        $this->graduate["image"] = $this->getString()->cleanString($this->graduate["name"]) . $this->getFiles()->setFileExtension();

        $this->getFiles()->uploadFile("img/graduates/", $this->getString()->cleanString($this->graduate["name"]));
        $this->getImage()->makeThumbnail("img/graduates/" . $this->graduate["image"], 150);
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
            $this->setGraduateData();
            $this->setGraduateImage();

            ModelFactory::getModel("Graduates")->createData($this->graduate);
            $this->getSession()->createAlert("Nouveau Diplômé Créé avec Succès !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/graduates/createGraduate.twig");
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
            $this->setGraduateData();

            if (!empty($this->getFiles()->getFileVar("name"))) {
                $this->setGraduateImage();
            }

            ModelFactory::getModel("Graduates")->updateData($this->getGet()->getGetVar("id"), $this->graduate);
            $this->getSession()->createAlert("Modification du Diplômé Sélectionné Effectuée !", "blue");

            $this->redirect("admin");
        }

        $graduate = ModelFactory::getModel("Graduates")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/graduates/updateGraduate.twig", ["graduate" => $graduate]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Graduates")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Diplômé Supprimé !", "red");

        $this->redirect("admin");
    }
}
