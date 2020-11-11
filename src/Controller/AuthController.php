<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AuthController
 * @package App\Controller
 */
class AuthController extends MainController
{
    /**
     * @var array
     */
    private $member = [];

    private function checkLogin()
    {
        $member = ModelFactory::getModel("Members")->readData($this->member["email"], "email");

        if (!password_verify($this->member["pass"], $member["pass"])) {
            $this->getSession()->createAlert("Failed authentication !", "black");

            $this->redirect("auth");
        }

        $this->getSession()->createSession($member);
        $this->getSession()->createAlert("Successful authentication, welcome " . $member["name"] . " !", "purple");

        $this->redirect("admin");
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if (!empty($this->getPost()->getPostArray())) {
            $this->member = $this->getPost()->getPostArray();

            /*if (isset($this->member["g-recaptcha-response"]) && !empty($this->member["g-recaptcha-response"])) {

                if ($this->getSecurity()->checkRecaptcha($this->member["g-recaptcha-response"])) {
                    */$this->checkLogin();/*
                }
            }

            $this->getSession()->createAlert("Check the reCAPTCHA !", "red");

            $this->redirect("auth");*/
        }

        return $this->render("front/login.twig");
    }

    public function logoutMethod()
    {
        $this->getSession()->destroySession();

        $this->redirect("home");
    }
}
