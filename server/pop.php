

		<?php
		$db = new SQLite3('jb.db');
		if ($_GET["raspID"]) {
			$sql = "DELETE FROM queue WHERE pi_owner='" . $_GET["raspID"]. "' LIMIT 1;";
			$results = $db->query($sql);
		}
		
		?>