<html>
<head>
	<title>PHP Test</title>
</head>
<body>

		<?php
		$db = new SQLite3('jb.db');
		if ($_GET["raspID"]) {
			$sql = "SELECT * FROM queue WHERE pi_owner='" . $_GET["raspID"]. "';";
			$results = $db->query($sql);
			//change this to queue 
			while ($row = $results->fetchArray()) {
	            echo($row['id']."</br>");
	            //echo("</tr>");
			}
		}
		
		?>
</body>
</html>