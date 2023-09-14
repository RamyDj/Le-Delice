<?php

namespace models;

use PDO;

class MenuRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = \config\Database::getpdo();
    }

    public function addMenu($titre, $contenu, $prix, $categorie)
    {
        $req = $this->pdo->prepare("INSERT INTO menu (titre, contenu, prix, categorie) VALUES (?,?,?,?)");
        $req->execute(array($titre, $contenu, $prix, $categorie));
        return $message = "menu ajouté avec succès";
    }

    public function list()
    {

        $select = $this->pdo->prepare("SELECT * FROM menu ");
        $select->execute();

        return $select->fetchall();
    }



    public function getAntipasti()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'ANTIPASTI / À PARTAGER'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInsalata()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'INSALATA'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPasta()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'PASTA'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPizza()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'PIZZA'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPesce()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'PESCE'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRisotto()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'RISOTTO'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarne()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'CARNE'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDolci()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'DOLCI DELLA CASA'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGelato()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'GELATO'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCocktails()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE categorie = 'COCKTAILS'");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenu(int $id_menu)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE id = ?");
        $stmt->execute([$id_menu]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modify($id, $titre, $contenu, $prix, $categorie)
    {
        $modify = $this->pdo->prepare("UPDATE menu SET titre=?, contenu=?, prix=?, categorie=? WHERE id=?");
        $modify->execute([$titre, $contenu, $prix, $categorie, $id]);
    }
}
