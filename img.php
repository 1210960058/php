<?php
	session_start();
try{

$pdo=new PDO('mysql:host=localhost;dbname=testid;charset=utf8','root','buturi',
array(PDO::ATTR_EMULATE_PREPARES => false));
}catch (PDOException $e){
exit('error'.$e->getMessage());
}



      $count = $_GET['count'];
      $id = $_GET['id'];


$search=$pdo->prepare('select * from '.$_SESSION["class"].' WHERE id=:id ORDER BY time');
$search ->bindParam(':id',$id);
$search ->execute();
$result = $search ->fetchAll();










header('Content-type: image/jpg');
echo $result[$count]['img_col'];
?>