<?php
class Bdd {
    private $bdd;

    public function __construct($host = 'localhost', $dbname = 'webcinema', $username = 'root', $password = '') {

        $this->bdd = new PDO("mysql:host=$host;dbname=$dbname; port=3307;", $username, $password);
        $this->bdd->exec("set names utf8");
    }

    public function getbdd() {
        return $this->bdd;
    }
}
?>
