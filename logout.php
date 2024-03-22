<?php
   session_start(); //otvorenie session

   unset($_SESSION["username"]); //vymazanie session
   
   echo '<link rel=stylesheet href="welcome.css">';
   echo '<div class=wrapper>';
   echo '<p>Bol si odhlásený.</p>';
   echo '<p>Smerujem naspäť.</p>';
   echo '</div>';

   header('Refresh: 2; URL = index.php'); // presmerovanie na prihlasenie
?>