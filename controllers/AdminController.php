<?php

namespace controllers;

use models\AdminRepository;
use models\BookRepository;
use models\MenuRepository;

class AdminController
{


    private $admin;
    private $book;
    private $menu;

    public function __construct()
    {
        $this->admin = new AdminRepository();
        $this->book = new BookRepository();
        $this->menu = new MenuRepository();
    }

    public function signinAdmin()
    {
        if ($_SESSION['id_role'] == 1) {
            if (isset($_POST['valider'])) {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Nettoyer l'e-mail
                $mdps = $_POST['mdp'];

                // Vérification que toutes les données sont présentes
                if (empty($nom) || empty($prenom) || empty($mail) || empty($mdps)) {
                    $erreur = "Tous les champs sont obligatoires.";
                    $page = "views/SignAdmin.phtml";
                    require_once "views/Base.phtml";
                    return;
                }

                // Vérification de la validité de l'e-mail
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $erreur = "L'adresse e-mail n'est pas valide.";
                    $page = "views/SignAdmin.phtml";
                    require_once "views/Base.phtml";
                    return;
                }

                // Vérification que le mot de passe répond aux critères
                if (strlen($mdps) < 6 || !preg_match('/[A-Z]/', $mdps) || !preg_match('/[0-9]/', $mdps)) {
                    $erreur = "Le mot de passe doit comporter au moins 6 caractères, incluant au moins une majuscule et un chiffre.";
                    $page = "views/SignAdmin.phtml";
                    require_once "views/Base.phtml";
                    return;
                }

                $mdp = password_hash($mdps, PASSWORD_DEFAULT);
                $idrole = 1;

                $signin = $this->admin->createAdmin($nom, $prenom, $mail, $mdp, $idrole);
            }

            $page = "views/SignAdmin.phtml";
            require_once "views/Base.phtml";
        } else {
            header('Location: /ledelice/user/login');
            exit();
        }
    }

    public function bookStatus()
    {
        if ($_SESSION['id_role'] == 1) {
            $show = $this->book->showBookA();

            $page = "views/BookAdmin.phtml";
            require_once "views/Base.phtml";
        } else {
            header('Location: /ledelice/user/login');
            exit();
        }
    }

    public function listMenuA()
    {
        if ($_SESSION['id_role'] == 1) {
            $Antipasti = $this->menu->getAntipasti();
            $Insalata = $this->menu->getInsalata();
            $Pasta = $this->menu->getPasta();
            $Pizza = $this->menu->getPizza();
            $Pesce = $this->menu->getPesce();
            $Risotto = $this->menu->getRisotto();
            $Carne = $this->menu->getCarne();
            $Dolci = $this->menu->getDolci();
            $Gelato = $this->menu->getGelato();
            $Cocktails = $this->menu->getCocktails();

            $page = "views/MenuAdmin.phtml";
            require_once "views/Base.phtml";
        } else {
            header('Location: /ledelice/user/login');
            exit();
        }
    }

    public function updateMenu($id_menu = "")
{
    if ($_SESSION['id_role'] == 1) {
        $menu = $this->menu->getMenu($id_menu);

        if (isset($_POST['valider'])) {
            $titre = $_POST["titre"];
            $contenu = $_POST["contenu"];
            $prix = $_POST["prix"];
            $categorie = $_POST["categorie"];

            // Définissez un tableau de catégories valides
            $categoriesValides = array(
                "ANTIPASTI / À PARTAGER",
                "INSALATA",
                "PASTA",
                "PIZZA",
                "PESCE",
                "RISOTTO",
                "CARNE",
                "DOLCI DELLA CASA",
                "GELATO",
                "COCKTAILS"
            );

            if (empty($titre) || empty($prix) || empty($categorie)) {
                $erreur = "Les champs Titre, Prix et Catégorie sont obligatoires.";
            } elseif (!in_array($categorie, $categoriesValides)) {
                $erreur = "Catégorie non valide.";
            } else {
                $menuModel = $this->menu->modify($id_menu, $titre, $contenu, $prix, $categorie);
                $menu = $this->menu->getMenu($id_menu);
            }
        }

        $page = "views/ModifMenu.phtml";
        require_once "views/Base.phtml";
    } else {
        header('Location: /ledelice/user/login');
        exit();
    }
}
}
