

		<?php
		$db = new SQLite3('jb.db');
		if ($_GET["raspID"]) {
			$sql = "SELECT * FROM queue WHERE pi_owner='" . $_GET["raspID"]. "';";
			$results = $db->query($sql);
			//change this to queue 
			$output = "";
			while ($row = $results->fetchArray()) {
				$output = $output . "," . $row['id'];
	            //echo("</tr>");
			}
			$output = rtrim($output, ',');
			$output = ltrim($output, ',');
			echo($output);
		}
		
		?>
