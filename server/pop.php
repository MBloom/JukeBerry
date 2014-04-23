<?php
 $db = new SQLite3('jb.db');
 if ($_GET["raspID"] and $_GET["songID"]) {
 	$sql = "DELETE FROM queue WHERE pi_owner='" . $_GET["raspID"]. "' AND id=".$_GET["songID"].";";
 	//echo($sql);
 	$results = $db->query($sql);
 	//echo($results);
 }
 
?>