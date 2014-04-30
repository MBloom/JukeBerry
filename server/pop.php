<?php
 $db = new SQLite3('jb.db');
 if ($_GET["raspID"] and $_GET["songID"]) {
 	$count_sql = "SELECT COUNT(*) FROM queue;";
    $drop_sql = "DELETE FROM nowPlaying WHERE pi_owner = '" .$_GET["raspID"]. "';";
    $insert_sql = "INSERT INTO nowPlaying SELECT * from queue WHERE pi_owner='" . $_GET["raspID"]. "' AND id=".$_GET["songID"].";";
    $sql = "DELETE FROM queue WHERE pi_owner='" . $_GET["raspID"]. "' AND id=".$_GET["songID"].";";
    $clear_NP_sql = "DELETE * FROM nowPlaying;";
 	//echo($sql);
 	$countresult = $db->query($count_sql);
 	$row = $countresult->fetchArray();
 	echo($row['count']);
 	var_dump($countresult);
 	$db->exec($drop_sql);
 	$insertresult = $db->exec($insert_sql);
 	echo ($insertresult."<br>");
 	echo ("Dropped " . $_GET["songID"]);
 	$results = $db->query($sql);
 	//echo($results);
 }
 
?>