
<?php require "header/navbar.php" ?>

<?php
 include('connection/connection.php');  
?>


<?php  

unset($_SESSION['userid']);
unset($_SESSION['username']);
unset($_SESSION['useremail']);
session_destroy();


header('location:login.php');

?>
