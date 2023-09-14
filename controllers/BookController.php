<?php

namespace controllers;

use models\BookRepository;

class BookController
{


    private $book;

    public function __construct()
    {
        $this->book = new BookRepository();
    }

    public function book()
    {

        if ($_SESSION['id_role'] == 2) {

            $idc = $_SESSION['id'];
            $show = $this->book->showBook($idc);

            if (isset($_POST['valider1'])) {
                $id_client = $_POST['id_client'];
                $nomClient = $_POST['nomClient'];
                $prenomClient = $_POST['prenomClient'];
                $nbClient = $_POST['nbClient'];
                $date = $_POST['date'];
                $newBook = $this->book->booking($id_client, $nomClient, $prenomClient, $nbClient, $date);

                $idc = $_SESSION['id'];
                $show = $this->book->showBook($idc);
            }
            $page = "views/Book.phtml";
            require_once "views/Base.phtml";
        } else {
            header('Location: /ledelice/user/login');
            exit();
        }


        $page = "views/Book.phtml";
        require_once "views/Base.phtml";
    }

    public function updateBook($id_book = "")
    {
        if ($_SESSION['id_role'] == 2) {
            $book = $this->book->getBook($id_book);

            if (isset($_POST['valider'])) {
                $nbClient = $_POST["nbClient"];
                $date = $_POST["date"];
                $bookModel = $this->book->modify($id_book, $nbClient, $date);
                $book = $this->book->getBook($id_book);
            }
            $page = "views/ModifBook.phtml";
            require_once "views/Base.phtml";
        } else {
            header('Location: /ledelice/user/login');
            exit();
        }
    }
}
