<?php
session_start();
try{

$pdo=new PDO('mysql:host=localhost;dbname=testid;charset=utf8','root','buturi',
array(PDO::ATTR_EMULATE_PREPARES => false));
}catch (PDOException $e){
exit('error'.$e->getMessage());
}
$_SESSION["class"]=$_POST["class"];
//echo $_SESSION["id"];
//echo $class;
$search=$pdo->prepare('select * from '.$_SESSION["class"].' WHERE id='.$_SESSION['id']);
$search ->execute();

while($_SESSION["result"] = $search ->fetch(PDO::FETCH_ASSOC)){

header('Content-type: text/html');
echo '<br>';
print($_SESSION["result"]['id']);
echo '<br>';
print($_SESSION["result"]['time']);
echo '<br>';
echo '<img src="img.php" />';


}


?>
