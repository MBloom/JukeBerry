<?php  


if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            echo($data[0]);
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location: import.php?success=1'); die; 

} 

?> 