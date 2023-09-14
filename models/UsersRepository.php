<?php

namespace models;

use PDO;

class UsersRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = \config\Database::getpdo();
    }
    public function findUser($mail)
    {
        $select = $this->pdo->prepare("SELECT * FROM client WHERE mail = ?");
        $select->execute(array($mail));

        return $select->fetch();
    }
    public function checkPassword($result, $password)
    {
        if (password_verify($password, $result["password"])) {
            $_SESSION["id"] = $result["id"];
            $_SESSION["id_role"] = $result["id_role"];
            $_SESSION["nom"] = $result["nom"];
            $_SESSION["prenom"] = $result["prenom"];
            return true;
        } else {
            return false;
        }
    }


    public function create($nom, $prenom, $mail, $mdp, $idrole)
    {
        $create = $this->pdo->prepare("INSERT INTO client(nom, prenom, mail, password, id_role) VALUES(?, ?, ?, ?, ?)");
        $create->execute(array($nom, $prenom, $mail, $mdp, $idrole));
    }

    public function list()
    {
        $select = $this->pdo->prepare("SELECT * FROM menu ");
        $select->execute();

        return $select->fetchall();
    }

    public function getUser($idUser)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->execute([$idUser]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modify($id, $nom, $prenom, $mail)
    {
        $modify = $this->pdo->prepare("UPDATE client SET nom=?, prenom=?, mail=? WHERE id=?");
        $modify->execute([$nom, $prenom, $mail, $id]);
    }

    public function emailExists($mail)
    {
        $sql = "SELECT COUNT(*) FROM client WHERE mail = :mail";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0; // Retourne vrai si l'e-mail existe déjà, sinon faux
    }
}
