<?php

$connection = new PDO("mysql:host=localhost;dbname=coffee-blend","root","");


try{

// echo "database is connected";

}catch(PDOExpection){

echo "database is not connected";
}

?>