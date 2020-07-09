<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ServiceController
 * @package App\Controller
 */
class ServiceController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $services = ModelFactory::getModel("Service")->listData();

        return $this->render("front/service.twig", ["services" => $services]);
    }

    private function setServiceData()
    {
        $service["name"]          = $this->getPost()->getPostVar("name");
        $service["description"]   = $this->getPost()->getPostVar("description");

        $service["icon"] = str_replace("fa-", "", $this->getPost()->getPostVar("icon"));
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
            $service["name"]          = $this->getPost()->getPostVar("name");
            $service["description"]   = $this->getPost()->getPostVar("description");

            $service["icon"] = str_replace("fa-", "", $this->getPost()->getPostVar("icon"));

            ModelFactory::getModel("Service")->createData($service);
            $this->getSession()->createAlert("New service created successfully !", "green");

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
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        if (!empty($this->getPost()->getPostArray())) {
            $service["name"]          = $this->getPost()->getPostVar("name");
            $service["description"]   = $this->getPost()->getPostVar("description");

            $service["icon"] = str_replace("fa-", "", $this->getPost()->getPostVar("icon"));

            ModelFactory::getModel("Service")->updateData($this->getGet()->getGetVar("id"), $service);
            $this->getSession()->createAlert("Successful modification of the selected service !", "blue");

            $this->redirect("admin");
        }

        $service = ModelFactory::getModel("Service")->readData($this->getGet()->getGetVar("id"));

        return $this->render("back/updateService.twig", ["service" => $service]);
    }

    public function deleteMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Service")->deleteData($this->getGet()->getGetVar("id"));
        $this->getSession()->createAlert("Service actually deleted !", "red");

        $this->redirect("admin");
    }
}
