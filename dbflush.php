<?php
	
	include('/Classes/Db.php');

	$DB = new DB();


		
		if($DB->link) {

			$DB->truncate();

			$DB->close();

		 }

?>