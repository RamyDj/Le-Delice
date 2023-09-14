<?php

namespace models;

use PDO;

class AdminRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = \config\Database::getpdo();
    }

    public function createAdmin($nom, $prenom, $mail, $mdp, $idrole)
    {
        $create = $this->pdo->prepare("INSERT INTO client(nom, prenom, mail, password, id_role) VALUES(?, ?, ?, ?, ?)");
        $create->execute(array($nom, $prenom, $mail, $mdp, $idrole));
    }
}
