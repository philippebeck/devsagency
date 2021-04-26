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

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if ($this->checkArray($this->getPost())) {

            $this->member = $this->getPost();
            $this->CheckSecurity();
        }

        return $this->render("front/login.twig");
    }

    private function CheckSecurity()
    {
        if (isset($this->member["g-recaptcha-response"]) && !empty($this->member["g-recaptcha-response"])) {

            if ($this->checkRecaptcha($this->member["g-recaptcha-response"])) {
                $this->checkLogin();
            }
        }

        $this->setSession([
            "message"   => "Vérifier le reCAPTCHA !", 
            "type"      => "red"
        ]);

        $this->redirect("users");
    }

    private function checkLogin()
    {
        $member = ModelFactory::getModel("Members")->readData(
            $this->member["email"], 
            "email"
        );

        if (!password_verify($this->member["pass"], $member["pass"])) {
            
            $this->setSession([
                "message"   => "Authentification Échouée !", 
                "type"      => "black"
            ]);

            $this->redirect("users");
        }

        $this->setSession($member);

        $this->setSession([
            "message"   => "Authentification Réussie, bienvenue " . $member["name"] . " !", 
            "type"      => "violet"
        ]);

        $this->redirect("admin");
    }

    public function logoutMethod()
    {
        $this->destroyGlobal();

        $this->redirect("home");
    }
}