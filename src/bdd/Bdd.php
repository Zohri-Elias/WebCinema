<?php
class Bdd {
    public $bdd;

    public function __construct($host = 'localhost', $dbname = 'webcinema', $username = 'root', $password = '') {

        $this->bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->bdd->exec("set names utf8");
    }

    public function getbdd() {
        return $this->bdd;
    }


}
?>
