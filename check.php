<!-- 	<?php 
			
					$event = $_POST['event'];
					$importance = $_POST['importance'];

					$mysql = new mysqli('localhost', 'root', 'Demaly100', 'events');
					$mysql -> query("INSERT INTO `root`(`event`,`importance`)
						VALUES('$event','$importance')");

					$mysql -> close();

					//$result = "SELECT * FROM `root` WHERE `event`='$event'" ;
		

		 
					header('Location: index.php');
	 ?> -->