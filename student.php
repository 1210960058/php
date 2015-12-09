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

$_SESSION["result"] = $search ->fetchAll();

echo $_SESSION["result"][0]['id']."さんの出欠表";
echo '<br>';
echo "授業名「".$_SESSION["class"]."」";

for($i=0;$i<16;$i++){
header('Content-type: text/html');
echo '<br>';
echo $i.'回目';
print($_SESSION["result"][$i]['time']);
echo '<br>';
echo '<img src="img.php?count='.$i.'" />';

if( empty($_SESSION["result"][$i]['id']) ){
  print '$varは0か空です。';
}
}
?>
