<?php

    include_once('/Classes/Db.php');

    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        $db = new DB();

        echo 'requested id to delete is : ' . $id;

        $db->delete($id);

        $db->close();

        
    } else {

        echo 'Couldn\'t establish AJAX connection. ';
    }

?>