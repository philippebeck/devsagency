<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ServicesController
 * @package App\Controller
 */
class ServicesController extends MainController
{
    /**
     * @var array
     */
    private $service = [];

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allServices = ModelFactory::getModel("Services")->listData();

        return $this->render("front/services.twig", ["allServices" => $allServices]);
    }

    private function setServiceData()
    {
        $this->service["name"]          = $this->getPost("name");
        $this->service["description"]   = trim($this->getPost("description"));
        $this->service["icon"]          = str_replace("fa-", "", $this->getPost("icon"));
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
            $this->setServiceData();

            ModelFactory::getModel("Services")->createData($this->service);

            $this->setSession([
                "message"   => "Nouveau Service Créé avec Succès !", 
                "type"      => "green"
            ]);

            $this->redirect("admin");
        }

        return $this->render("back/createService.twig");
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
            $this->setServiceData();

            ModelFactory::getModel("Services")->updateData(
                $this->getGet("id"), 
                $this->service
            );

            $this->setSession([
                "message"   => "Modification du Service Sélectionné Effectuée !", 
                "type"      => "blue"
            ]);

            $this->redirect("admin");
        }

        $service = ModelFactory::getModel("Services")->readData($this->getGet("id"));

        return $this->render("back/updateService.twig", ["service" => $service]);
    }

    public function deleteMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Services")->deleteData($this->getGet("id"));

        $this->setSession([
            "message"   => "Service Supprimé !", 
            "type"      => "red"
        ]);

        $this->redirect("admin");
    }
}
