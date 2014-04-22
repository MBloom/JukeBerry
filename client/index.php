<?

//require_once 'mysql.php';
require_once 'constants.php';

//$mysql = new Mysql();
session_start();

// slc4ga - testest
// steph.colen - dauQba?3

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="google-site-verification" content="w73s3aUEynat16Jim77MOnkiGAjVOC4baQPwBomLe-w" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <? echo SITE_NAME; ?> Home</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css">
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!--<script src="bootstrap/js/bootbox.js"></script> -->
        <script type="text/javascript">
        
            $(function() {
                // Setup drop down menu
                $('.dropdown-toggle').dropdown();
     
                // Fix input element click problem
                $('.dropdown input, .dropdown label').click(function(e) {
                    e.stopPropagation();
                });
            });
            
        </script>
        
    </head>
    <body>
    
        <div class="container">
            <?
                include 'navbar.php';
            ?>
            <div class="row">
                <div class="col-md-12">
                    <td>
                         <img src="images/diginit_Home.png" alt="diginit Home" />
                    </td>
                </div>
            </div>
            

            
            <div class="row">
                <div class="col-md-2">
                        
                </div>
                <div class="col-md-8">
                    <h2 style="font-family: Monospace; text-align: center;">Music anywhere.  Music always.</h2>
                    <p  style="font-family: Monospace;">DIGINIT aims to make playing music from multiple devices a walk in the park.
                        By chosing a single phone to host a Jam Session, you and your friends can compile music onto a communal playlist
                        that can be played from the host device.  At parties never again will you deal with having to switch out phones
                        between songs.</p>                                                                           
                </div>
            </div>
            
            <?
                include 'footerHome.php';
            ?>
        
        </div>
        
        <script type="text/javascript">
        
            $(function(){
                $("#user, #admin").change(function(){
                    $("#adminpass").val("").attr("disabled",true);
                    if($("#admin").is(":checked")){
                        $("#adminpass").removeAttr("disabled");
                        $("#adminpass").focus();
                    }
                });
            });
        
        </script> 
        
    </body>
    
</html>