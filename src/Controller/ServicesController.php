<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
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
        $this->service["name"]          = $this->getPost()->getPostVar("name");
        $this->service["description"]   = $this->getPost()->getPostVar("description");
        $this->service["icon"]          = str_replace("fa-", "", $this->getPost()->getPostVar("icon"));
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
            $this->setServiceData();

            ModelFactory::getModel("Services")->createData($this->service);
            $this->getSession()->createAlert("New service created successfully !", "green");

            $this->redirect("admin");
        }

        return $this->render("back/services/createService.twig");
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
            $this->setServiceData();

            ModelFactory::getModel("Services")->updateData($this->getGet()->getGetVar("id"), $this->service);
            $this->getSession()->createAlert("Successful modification of the selected services !", "blue");

            $this->redirect("admin");
        }

        $service = ModelFactory::getModel("Services")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/services/updateService.twig", ["service" => $service]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Services")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Service actually deleted !", "red");

        $this->redirect("admin");
    }
}
