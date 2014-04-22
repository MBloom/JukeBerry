<?
    session_start();
    require_once 'constants.php';

    $pageName = $_SERVER['PHP_SELF'];
?>

<html>
    
    <div style="display: block">
    <h1 style="float:left; display: block;"> 
        <a href="index.php"> 
            <img src="images/diginit_Logo.png" alt="diginit Logo" height=auto width="100%" style="display: block;"/>
        </a>
    </h1>

    <h2 style="float:right; width:300px;"> 
                 <script>
  (function() {
    var cx = '000182373842752844549:kpkmbgkkuro';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
<h2>

    <div style="float:right; display: block" >
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                    <a href="http://www.twitter.com/" style="color: #ffffff;">
                        <img src="images/tw.png" alt="Twitter" width="38" height="38" 
                             style="display: block; padding-top: 20px" border="0" />
                    </a>
                </td>
                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                    <a href="http://www.facebook.com/" style="color: #ffffff;">
                        <img src="images/fb.png" alt="Facebook" width="38" height="38" 
                             style="display: block; padding-top: 20px;" border="0" />
                    </a>
                </td>
            </tr>
        </table>
    </div>
    </div>

    <div class="navbar" style="clear:both">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li <? if ($pageName == "/~slc4ga/ecomm/about.php") { echo "class=\"active\""; } ?> >
                        <a href="about.php">About</a></li>
                    <?
                        if(isset($_SESSION['role']) && $_SESSION['role'] == "developer") {
                            echo "<li";
                                if ($pageName == "/~slc4ga/ecomm/tickets.php") { 
                                    echo " class=\"active\""; 
                                }
                            echo "><a href=\"tickets.php\">Tickets</a></li>";
                        }
                        // have a developers button if user is admin
                        if(isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                            echo "<li";
                                if ($pageName == "/~slc4ga/ecomm/devs.php") { 
                                    echo " class=\"active\""; 
                                }
                            echo "><a href=\"devs.php\">Developers</a></li>";
                        }

                        if(isset($_SESSION['email'])) {
                            echo "<li";
                                if ($pageName == "/~slc4ga/ecomm/bugform.php") { echo " class=\"active\""; }
                            echo "><a href=\"bugform.php\">Submit</a></li>";
                        }
                    ?>
                    <li <? if ($pageName == "/~slc4ga/ecomm/contact.php") { echo "class=\"active\""; } ?> >
                        <a href="contact.php">Contact</a></li>
                </ul>
                <ul class="nav pull-right">
                    <?
                        // have a sign up/sign in button if no user is logged in
                        if(!isset($_SESSION['email'])) {
                            echo "<li class=\"dropdown\">";
                            echo "<a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\">
                                Sign Up<strong class=\"caret\"></strong></a>";
                            echo "<div class=\"dropdown-menu\" style=\"padding: 15px; padding-bottom:
                                                          0px;\">";
                                    include 'createAccount.php';
                            echo "</div>";
                            echo "</li>";
                            echo "<li class=\"divider-vertical\"></li>";
                            echo "<li class=\"dropdown\">";
                            echo "<a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\">Sign In  
                                <strong class=\"caret\"></strong></a>";
                            echo "<div class=\"dropdown-menu\" style=\"padding: 15px; padding-bottom:
                                                          0px;\">";
                                    include 'login.php';
                            echo "</div>";
                            echo "</li>";
                        }
                        else {          // otherwise have account / logout button
                            // have a My account button if user is logged in
                            echo "<li";
                                if ($pageName == "/~slc4ga/ecomm/userHome.php") { echo " class=\"active\""; }
                                echo "><a href=\"userHome.php\">My Account</a></li>";
                            echo "<li class=\"divider-vertical\"></li>";
                            echo "<li><a href=\"logout.php\">Logout</a></li>";   
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div> 
</html>