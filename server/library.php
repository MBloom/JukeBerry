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

    $sql = "INSERT INTO songs (id, artist,album,title,pi_owner) VALUES (".sanitize($firstrow[4]).",'".sanitize($firstrow[1])."','".sanitize($firstrow[2])."','".sanitize($firstrow[3])."','".sanitize($firstrow[0])."');";
    $result = $db->exec($sql);
    echo($sql);
        //loop through the csv file and insert into database 

    do { 

        if ($data[0]) { 
             $sql = "INSERT INTO songs (id, artist,album,title,pi_owner) VALUES (".sanitize($data[4]).",'".sanitize($data[1])."','".sanitize($data[2])."','".sanitize($data[3])."','".sanitize($data[0])."');";
            $result = $db->exec($sql);
            //echo($result."<br>");
            echo("<tr>");
            echo("<td>".sanitize($data[4])."</td>");
            echo("<td>".sanitize($data[1])."</td>");
            echo("<td>".sanitize($data[2])."</td>");
            echo("<td>".sanitize($data[3])."</td>");
            echo("<td>".sanitize($data[0])."</td>");
            echo("</tr>");
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    //header('Location: phptest.php?success=1'); die; 

} 
function sanitize($inputstring) {
    $result = $inputstring;
    $result = str_replace(" - ", "-", $result);
    $result = str_replace("(","[",$result);
    $result = str_replace(")", "]", $result);
    return SQLite3::escapestring($result);
}
?> 

</table>