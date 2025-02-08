<?php

class homeController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function show() {
        include "app/views/home.php";
    }
}
?>
