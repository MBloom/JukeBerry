<html>
<head>
	<title>PHP Test</title>
</head>
<body>
	<table>
		<tr>
			<th>ID</th>
			<th>Artist</th>
			<th>Album</th>
			<th>SongName</th>
			<th>RBPName</th>
		</tr>
		<?php
		$db = new SQLite3('jb.db');

				//change this to queue 
		$results = $db->query('SELECT * FROM songs');
		while ($row = $results->fetchArray()) {
			//var_dump($row);
			echo("<tr>");
            echo("<td>".$row['id']."</td>");
            echo("<td>".$row['artist']."</td>");
            echo("<td>".$row['album']."</td>");
            echo("<td>".$row['title']."</td>");
            echo("<td>".$row['pi_owner']."</td>");
            echo("</tr>");
		}
		?>
	</table>
</body>
</html>