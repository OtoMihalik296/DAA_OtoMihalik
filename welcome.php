<?php
session_start(); //otvorenie session

//zistenie ci je session nastavene
if(isset($_SESSION['meno']) ) {
    echo '<link rel=stylesheet href="welcome.css">';
    echo '<div class=wrapper>';
    echo '<p>Welcome <span>'.$_SESSION['meno'].'</span></p><br>';
    echo '<p>Click here to <a href = "logout.php" tite = "Logout">logout.</p>';//odkaz na odhlasenie
    echo '</div>';
}
?>