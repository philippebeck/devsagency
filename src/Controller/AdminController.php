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
        if ($this->service->getSecurity()->checkIsAdmin() !== true) {
            $this->redirect("home");
        }

        $projects   = ModelFactory::getModel("Project")->listData();
        $users      = ModelFactory::getModel("User")->listData();

        $projects   = array_reverse($projects);

        return $this->render("back/admin.twig", [
            "projects"  => $projects,
            "users"     => $users
        ]);
    }
}

