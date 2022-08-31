<?php
session_start();
if(isset($_SESSION["username"]))
{
    echo  "<h3> task done" . $_SESSION["username"] . "</h3>";
    echo  "<a href='logout.php'> logout</a>";
}
else{
    header("location:index.php");

}


?>