<?php

    include_once('/Classes/Db.php');

    if( isset($_GET['load'])) {


        $value = $_GET['load'];  //true or false

        $validSort = false; // false by default until explicit check
        $desc = false;  
        $sortBy;
        
        

        if ($value) {

            // if sortBy is supplied from JS then continue to check
            if (!empty($_GET['sortBy'])) {

                $sortBy = $_GET['sortBy'];

                // check if sortBy is actually one of the valid sort methods
                if ($sortBy == 'id' || $sortBy == 'todo' || $sortBy == 'date') {

                    
                    $validSort = true;

                    if ($validSort) {

                        //if it is - check if descending sort is also supplied (desc is either true or false)
                        if (isset($_GET['desc'])) {
                            
                            $desc = $_GET['desc'];

                        } 
                    }

                }

            }

            //end optional parameters check

            $db = new DB(); //instantiate DB
            $result;
            
            if ($validSort && $desc == false) {

                $result = $db->select($sortBy, false); //sort results by supplied field

            
            } elseif ($validSort && $desc) {
                 
                $result = $db->select($sortBy, true); //add descending order

            } else { 
                
                $result = $db->select();   //default case - select all fields without sorting

            } 
                
            if ($result) {

                    $responseArray = array();

                    while($row = mysqli_fetch_assoc($result)) {

                        $responseArray[] = $row;

                    }

                   echo json_encode($responseArray);

            }

            $db->close();

        }       
       
        
    } else {

        echo "Invalid call - GET method is not set.";

        $db->close();
    }

?>