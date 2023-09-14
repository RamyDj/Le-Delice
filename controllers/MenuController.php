<?php

namespace controllers;

use models\AdminRepository;
use models\MenuRepository;

class MenuController
{


    private $menu;

    public function __construct()
    {
        $this->menu = new MenuRepository();
    }

    public function add()
    {

        $page = "views/AjoutMenu.phtml";
        require_once "views/Base.phtml";
    }

    public function addPost()
{
    if ($_SESSION['id_role'] == 1) {
        $titre = htmlspecialchars($_POST["titre"]);
        $contenu =  htmlspecialchars($_POST["contenu"]);
        $prix = htmlspecialchars($_POST["prix"]);
        $categorie = htmlspecialchars($_POST["categorie"]);

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
            $page = "views/AjoutMenu.phtml";
            require_once "views/Base.phtml";
            return;
        }

        // Vérifiez si la catégorie soumise est valide
        if (!in_array($categorie, $categoriesValides)) {
            $erreur = "Catégorie non valide.";
            $page = "views/AjoutMenu.phtml";
            require_once "views/Base.phtml";
            return;
        }

        $register = $this->menu->addMenu($titre, $contenu, $prix, $categorie);
        return header("Location: /ledelice/admin/listMenuA");
        exit();
    } else {
        header('Location: /ledelice/user/login');
        exit();
    }
}

    public function listmenu()
    {
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


        $page = "views/Menu.phtml";
        require_once "views/Base.phtml";
    }
}
