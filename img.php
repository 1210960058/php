<?php
	session_start();
try{

$pdo=new PDO('mysql:host=localhost;dbname=testid;charset=utf8','root','buturi',
array(PDO::ATTR_EMULATE_PREPARES => false));
}catch (PDOException $e){
exit('error'.$e->getMessage());
}

$search=$pdo->prepare('select * from '.$_SESSION["class"].' WHERE id='.$_SESSION["id"]);
$search ->execute();

$result = $search ->fetch(PDO::FETCH_ASSOC);

$contents_type = array(
'jpg' => 'image/jpeg',
'png' => 'image/png',
);




header('Content-type: image/jpg');
echo $_SESSION["result"]['img_col'];
?>