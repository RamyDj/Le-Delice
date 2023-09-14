<?php

namespace controllers;

use models\UsersRepository;
use models\BookRepository;

class UserController
{

    private $user;
    private $book;

    public function __construct()
    {
        $this->user = new UsersRepository();
        $this->book = new BookRepository();
    }



    public function indexlog()
    {

        $page = "views/Accueil.phtml";
        require_once "views/Base.phtml";
    }

    public function login()
    {

        if (isset($_POST['valider'])) {

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['email']);
            $mdps = $_POST['mdp'];

            // Vérification que toutes les données sont présentes
            if (empty($nom) || empty($prenom) || empty($mail) || empty($mdps)) {

                $erreur = "Tous les champs sont obligatoires.";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
                return;
            }

            // Vérification que le mot de passe répond aux critères
            if (strlen($mdps) < 6 || !preg_match('/[A-Z]/', $mdps) || !preg_match('/[0-9]/', $mdps)) {

                $erreur = "Le mot de passe doit comporter au moins 6 caractères, incluant au moins une majuscule et un chiffre.";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
                return;
            }

            // Vérification de la validité de l'e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erreur = "L'adresse e-mail n'est pas valide.";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
                return; // Arrêter l'exécution
            }

            // Vérification si l'e-mail est déjà utilisé
            if ($this->user->emailExists($mail)) {
                $erreur = "Cet e-mail est déjà associé à un compte.";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
                return; // Arrêter l'exécution
            }

            $mdp = password_hash($mdps, PASSWORD_DEFAULT);
            $idrole = 2;

            $signin = $this->user->create($nom, $prenom, $mail, $mdp, $idrole);
        }

        $page = "views/Log.phtml";
        require_once "views/Base.phtml";
    }

    public function loginPost()
    {
        session_start();

        if (isset($_POST['connect'])) {
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // Nettoyer l'e-mail
            $password = $_POST["password"];

            // Vérification que toutes les données sont présentes
            if (empty($email) || empty($password)) {
                $erreur = "Tous les champs sont obligatoires.";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
                return; // Arrêter l'exécution
            }

            // Vérification de la validité de l'e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erreur = "L'adresse e-mail n'est pas valide.";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
                return; // Arrêter l'exécution
            }

            // Vérification que le mot de passe répond aux critères
            if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
                $erreur = "Le mot de passe doit comporter au moins 6 caractères, incluant au moins une majuscule et un chiffre.";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
                return; // Arrêter l'exécution
            }

            $result = $this->user->findUser($email);
            $message = $this->user->checkPassword($result, $password);

            if ($message) {
                header("Location: /ledelice/user/indexlog");
            } else {
                $erreur = "Mauvais mot de passe";
                $page = "views/Log.phtml";
                require_once "views/Base.phtml";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        return header('Location: /ledelice/user/indexlog');
    }

    public function myProfil()
    {
        if ($_SESSION['id_role'] == 2) {

            $page = "views/Profil.phtml";
            require_once "views/Base.phtml";
        } else {
            header('Location: /ledelice/user/login');
            exit();
        }
    }

    public function modifyProfil()
    {

        if ($_SESSION['id_role'] == 2) {
            $idUser = $_SESSION['id'];
            $user = $this->user->getUser($idUser);

            if (isset($_POST['valider'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $mail = $_POST['mail'];
                $id = $_SESSION['id'];
                $userModel = $this->user->modify($id, $nom, $prenom, $mail);

                $user = $this->user->getUser($idUser);
            }


            $page = "views/ModifProfil.phtml";
            require_once "views/Base.phtml";
        } else {
            header('Location: /ledelice/user/login');
            exit();
        }
    }
}
