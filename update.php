<?php

    include_once('/Classes/Db.php');

    if (isset($_POST['id']) && isset($_POST['text'])) {

       $id = $_POST['id']; 
       $text = $_POST['text'];

       $db = new DB();

       $result = $db->update($id, $text);

        if ($result) {
            
            echo "Success!";
        } else {

            printf("Errormessage: %s\\n", mysqli_error($db->link));
        }


       


    }
?>