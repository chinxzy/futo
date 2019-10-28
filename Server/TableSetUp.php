
<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>
    <h3>Setting up...</h3>

<?php 
  require_once 'Dependencies.php';

 #How the Data would be stored in MySql database...
  CreateTable('Data',
              ' Name VARCHAR(10),
			    Phone INT,
				Level INT(3),
				LodgeName VARCHAR(255),
				Location VARCHAR(255),
				Description VARCHAR(1024),
				Image  VARCHAR(1024),
				UploadTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
?>

 <br>...done.
  </body>
</html>
