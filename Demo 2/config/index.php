<?php
    require_once "createDB.php";
    require_once "initDB.php";

    /**
     * We use this script to create and initialize a database
     */
    $create = new CreateDatabase();
    $create = null;

    $init = new InitDatabase();
    $init = null;
?>