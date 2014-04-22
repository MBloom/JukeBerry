<html>
<head>
<title>PHP Test</title>
</head>
<body>
<?php
$db = new SQLite3('jb.db');

				//change this to queue 
$results = $db->query('SELECT * FROM songs');
while ($row = $results->fetchArray()) {
	//change this to index
    echo "ID = " . $row['id'];
}
?>
</body>
</html>