<table>
<tr>
<th>ID</th>
<th>Artist</th>
<th>Album</th>
<th>SongName</th>
<th>RBPName</th>
</tr>
<?php  


if ($_FILES[csv][size] > 0) { 
    //open database
    $db = new SQLite3('jb.db');

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 

    //drop all existing entries
    $firstrow = fgetcsv($handle,1000,",","'");
    $RBP_ID = $firstrow[0];
    $drop_sql = "DELETE FROM songs WHERE pi_owner = '" .$RBP_ID. "';";
    //echo($drop_sql."<br>");
    $result = $db->exec($drop_sql);
    //echo($result."<br>");

    $sql = "INSERT INTO songs (id, artist,album,title,pi_owner) VALUES (".SQLite3::escapeString($firstrow[4]).",'".SQLite3::escapeString($firstrow[1])."','".SQLite3::escapeString($firstrow[2])."','".SQLite3::escapeString($firstrow[3])."','".SQLite3::escapeString($firstrow[0])."');";
    $result = $db->exec($sql);
    echo($sql);
        //loop through the csv file and insert into database 

    do { 

        if ($data[0]) { 
             $sql = "INSERT INTO songs (id, artist,album,title,pi_owner) VALUES (".SQLite3::escapeString($data[4]).",'".SQLite3::escapeString($data[1])."','".SQLite3::escapeString($data[2])."','".SQLite3::escapeString($data[3])."','".SQLite3::escapeString($data[0])."');";
            $result = $db->exec($sql);
            //echo($result."<br>");
            echo("<tr>");
            echo("<td>".$data[4]."</td>");
            echo("<td>".$data[1]."</td>");
            echo("<td>".$data[2]."</td>");
            echo("<td>".$data[3]."</td>");
            echo("<td>".$data[0]."</td>");
            echo("</tr>");
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    //header('Location: phptest.php?success=1'); die; 

} 

?> 

</table>