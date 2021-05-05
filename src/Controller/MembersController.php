<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class MembersController
 * @package App\Controller
 */
class MembersController extends MainController
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
        $allMembers = ModelFactory::getModel("Members")->listData();

        return $this->render("front/members.twig", ["allMembers" => $allMembers]);
    }

    private function setMemberData()
    {
        $this->member["name"]       = (string) trim($this->getPost("name"));
        $this->member["email"]      = (string) trim($this->getPost("email"));
        $this->member["linkedin"]   = (string) trim($this->getPost("linkedin"));
        $this->member["github"]     = (string) trim($this->getPost("github"));

        $this->member["website"]    = (string) trim($this->getPost("website"));
        $this->member["website"]    = str_replace("https://", "", $this->member["website"]);

        $this->member["position"]       = (string) trim($this->getPost("position"));
        $this->member["city"]           = (string) trim($this->getPost("city"));
        $this->member["presentation"]   = (string) trim($this->getPost("presentation"));
    }

    private function setMemberImage()
    {
        $this->member["image"] = $this->getString($this->member["name"]) . $this->getExtension();

        $this->getUploadedFile("img/members/", $this->getString($this->member["name"]));
        $this->getThumbnail("img/members/" . $this->member["image"], 200);
    }

    private function setUpdateData()
    {
        $this->setMemberData();

        if ($this->checkArray($this->getFiles("file"), "name")) {
            $this->setMemberImage();
        }

        if ($this->checkArray($this->getPost(), "old-pass")) {
            $this->setUpdatePassword();
        }

        ModelFactory::getModel("Members")->updateData(
            $this->getGet("id"), 
            $this->member
        );

        $this->setSession([
            "message"   => "Modification du Membre réussie !", 
            "type"      => "blue"
        ]);

        $this->redirect("admin");
    }

    private function setUpdatePassword()
    {
        $member = ModelFactory::getModel("Members")->readData($this->getGet("id"));

        if (!password_verify($this->getPost("old-pass"), $member["pass"])) {

            $this->setSession([
                "message"   => "L'Ancien Mot de Passe est Incorrect !", 
                "type"      => "red"
            ]);

            $this->redirect("admin");
        }

        if ($this->getPost("new-pass") !== $this->getPost("conf-pass")) {

            $this->setSession([
                "message"   => "Les Nouveaux Mots de Passe ne Correspondent pas !", 
                "type"      => "red"
            ]);

            $this->redirect("admin");
        }

        $this->member["pass"] = password_hash(
            $this->getPost("new-pass"), 
            PASSWORD_DEFAULT
        );
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
            $this->setMemberData();
            $this->setMemberImage();

            if ($this->getPost("pass") !== $this->getPost("conf-pass")) {

                $this->setSession([
                    "message"   => "Les Mots de Passe ne Correspondent pas !", 
                    "type"      => "red"
                ]);

                $this->redirect("members!create");
            }

            $this->member["pass"] = password_hash(
                $this->getPost("pass"), 
                PASSWORD_DEFAULT
            );

            ModelFactory::getModel("Members")->createData($this->member);

            $this->setSession([
                "message"   => "Nouveau Membre Créé avec Succès !", 
                "type"      => "green"
            ]);

            $this->redirect("admin");
        }

        return $this->render("back/createMember.twig");
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
            $this->setUpdateData();
        }

        $member = ModelFactory::getModel("Members")->readData($this->getGet("id"));

        return $this->render("back/updateMember.twig", ["member" => $member]);
    }

    public function deleteMethod()
    {
        if ($this->checkAdmin() !== true) {
            $this->redirect("home");
        }

        ModelFactory::getModel("Members")->deleteData($this->getGet("id"));

        $this->setSession([
            "message"   => "Membre Supprimé !", 
            "type"      => "red"
        ]);

        $this->redirect("admin");
    }
}
