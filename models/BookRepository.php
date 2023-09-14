<?php

namespace models;

use PDO;

class BookRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = \config\Database::getpdo();
    }

    public function booking($id_client, $nomClient, $prenomClient, $nbClient, $date)
    {
        $insert = $this->pdo->prepare("INSERT INTO book(id_client, nomClient, prenomClient, nbClient, date) VALUES (?, ?, ?, ?, ?)");
        $insert->execute([$id_client, $nomClient, $prenomClient, $nbClient, $date]);
    }

    public function showBookA()
    {
        $show = $this->pdo->prepare("SELECT * FROM book WHERE date >= NOW() ORDER BY date ASC");
        $show->execute();

        return $show->fetchAll();
    }

    public function modifyBook($id, $nbClient, $date)
    {
        $modify = $this->pdo->prepare("UPDATE book SET nbClient=?, date=? WHERE id=?");
        $modify->execute([$nbClient, $date, $id]);
    }

    public function showBook($idc)
    {
        $show = $this->pdo->prepare("SELECT * FROM book WHERE date >= NOW() AND id_client=? ORDER BY date ASC ");
        $show->execute([$idc]);

        return $show->fetchAll();
    }

    public function getbook(int $id_book)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM book WHERE id = ?");
        $stmt->execute([$id_book]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modify($id, $nbClient, $date)
    {
        $modify = $this->pdo->prepare("UPDATE book SET nbClient=?, date=? WHERE id=?");
        $modify->execute([$nbClient, $date, $id]);
    }
}
