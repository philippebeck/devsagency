<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if ($this->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        $allServices    = ModelFactory::getModel("Services")->listData();
        $allProjects    = ModelFactory::getModel("Projects")->listData();
        $allGraduates   = ModelFactory::getModel("Graduates")->listData();
        $allMembers     = ModelFactory::getModel("Members")->listData();

        $allProjects = array_reverse($allProjects);

        return $this->render("back/admin.twig", [
            "allProjects"   => $allProjects,
            "allServices"   => $allServices,
            "allGraduates"  => $allGraduates,
            "allMembers"    => $allMembers
        ]);
    }
}

