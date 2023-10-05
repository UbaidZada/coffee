<?php



try{
    
    $connection = new PDO("mysql:host=localhost;dbname=coffee-blend","root","");
// echo "database is connected";

}catch(PDOExpection){

echo "database is not connected";
}

?>