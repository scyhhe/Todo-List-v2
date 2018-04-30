<?php

include_once('/Classes/Db.php');

    if (isset($_POST['todo'])) {

        $todo = $_POST['todo'];

        $tags = "";

        if (isset($_POST['tags'])) {

            $tags = $_POST['tags'];
        }

        $timestamp = date('Y-m-d');

        $db = new DB();

        $result = $db->insert($todo, $tags, $timestamp);

        if ($result) {

            echo "success";
        }

        
        $db->close();

    }

?>