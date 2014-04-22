<table>
<tr>
<th>ID</th>
<th>Artist</th>
<th>Album</th>
<th>SongName</th>
</tr>
<?php  


if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            echo("<tr>");
            echo("<td>".$data[3]."</td>");
            echo("<td>".$data[0]."</td>");
            echo("<td>".$data[1]."</td>");
            echo("<td>".$data[2]."</td>");
            echo("</tr>");
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    //header('Location: phptest.php?success=1'); die; 

} 

?> 
</table>